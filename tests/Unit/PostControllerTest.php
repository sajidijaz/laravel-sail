<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    protected Post $post;
    protected array $payload;
    protected int $userId;

    public function setUp(): void
    {
        parent::setUp();
        $this->userId = User::all()->random()->id;
        $this->payload = [
            'user_id' => $this->userId,
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph
        ];
        $this->post = Post::create($this->payload);
    }

    public function testRequiredFieldsForCreatingPost(): void
    {
        $this->json('POST', 'api/posts', ['Accept' => 'application/json'])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(
                [
                    "message" => "The user id field is required. (and 2 more errors)",
                    "errors" => [
                        "user_id" => ["The user id field is required."],
                        "title" => ["The title field is required."],
                        "body" => ["The body field is required."],
                    ]
                ]
            );
    }

    public function testPostSuccessfulCreated(): void
    {
        $this->json('POST', 'api/posts', $this->payload, ['Accept' => 'application/json'])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "error",
                    "message",
                    "data" => [
                        "user_id",
                        "title",
                        "body"
                    ]
                ]
            );
        $this->assertDatabaseHas('posts', $this->payload);
    }

    public function testPostIsDestroyed(): void
    {
        $this->json('delete', "api/posts/". $this->post->id, ['Accept' => 'application/json'])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "error",
                    "message",
                    "data"
                ]
            );
        $this->assertDatabaseMissing('posts', $this->payload);
    }

    public function testUpdatePostReturnsCorrectData(): void
    {
        $this->json('put', "api/posts/" . $this->post->id, $this->payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'error' => false,
                    'message' => 'Post Updated Successfully',
                    'data' => [
                        'id' => $this->post->id,
                        'user_id' => $this->payload['user_id'],
                        'title' => $this->payload['title'],
                        'body' => $this->payload['body'],
                        'created_at' => $this->post->created_at,
                        'updated_at' => $this->post->updated_at
                    ]
                ]
            );
    }

    public function testReturnPostDataById(): void
    {
        $this->json('get', "api/posts/" . $this->post->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'error' => false,
                    'message' => null,
                    'data' => [
                        'id' => $this->post->id,
                        'user_id' => $this->payload['user_id'],
                        'title' => $this->payload['title'],
                        'body' => $this->payload['body'],
                        'created_at' => $this->post->created_at,
                        'updated_at' => $this->post->updated_at
                    ]
                ]
            );
    }

    public function testReturnPostFilterData(): void
    {
        $this->json('get', "api/posts?filter[userId]=" . $this->userId)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "error",
                    "message",
                    "data" => [
                        "data"
                    ]
                ]
            );
    }

    public function testValidatePostRequest(): void
    {
        $this->json('get', "api/posts?filter[userId]=0")
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(
                [
                    "message" => "The filter user id must be at least 1.",
                    "errors" => [
                        "filter.userId" => ["The filter user id must be at least 1."]
                    ]
                ]
            );
    }

}
