<?php

namespace Tests\Unit;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    protected Todo $todo;
    protected array $payload;
    protected int $userId;

    public function setUp(): void
    {
        parent::setUp();
        $this->userId = User::all()->random()->id;
        $this->payload = [
            'user_id' => $this->userId,
            'title' => $this->faker->sentence,
            'status' => 'pending',
            'due_on' => $this->faker->date,
        ];
        $this->todo = Todo::create($this->payload);
    }

    public function testRequiredFieldsForCreatingTodo(): void
    {
        $this->json('POST', 'api/todos', ['Accept' => 'application/json'])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(
                [
                    "message" => "The user id field is required. (and 3 more errors)",
                    "errors" => [
                        "user_id" => ["The user id field is required."],
                        "title" => ["The title field is required."],
                        "due_on" => ["The due on field is required."],
                        "status" => ["The status field is required."],
                    ]
                ]
            );
    }

    public function testTodoSuccessfulCreated(): void
    {
        $this->json('POST', 'api/todos', $this->payload, ['Accept' => 'application/json'])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "error",
                    "message",
                    "data" => [
                        "user_id",
                        "title",
                        "status",
                        "due_on"
                    ]
                ]
            );
        $this->assertDatabaseHas('todos', $this->payload);
    }

    public function testTodoIsDestroyed(): void
    {
        $this->json('delete', "api/todos/" . $this->todo->id, ['Accept' => 'application/json'])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "error",
                    "message",
                    "data"
                ]
            );
        $this->assertDatabaseMissing('todos', $this->payload);
    }

    public function testUpdatePostReturnsCorrectData(): void
    {
        $this->json('put', "api/todos/" . $this->todo->id, $this->payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'error' => false,
                    'message' => 'Todo Updated Successfully',
                    'data' => [
                        'id' => $this->todo->id,
                        'user_id' => $this->payload['user_id'],
                        'title' => $this->payload['title'],
                        'status' => $this->payload['status'],
                        'due_on' => $this->payload['due_on'],
                        'created_at' => $this->todo->created_at,
                        'updated_at' => $this->todo->updated_at
                    ]
                ]
            );
    }

    public function testReturnPostDataById(): void
    {
        $this->json('get', "api/todos/" . $this->todo->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'error' => false,
                    'message' => null,
                    'data' => [
                        'id' => $this->todo->id,
                        'user_id' => $this->payload['user_id'],
                        'title' => $this->payload['title'],
                        'status' => $this->payload['status'],
                        'due_on' => $this->payload['due_on'],
                        'created_at' => $this->todo->created_at,
                        'updated_at' => $this->todo->updated_at
                    ]
                ]
            );
    }

    public function testReturnTodoFilterData(): void
    {
        $this->json('get', "api/todos?filter[userId]=" . $this->userId)
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

    public function testValidateTodoRequest(): void
    {
        $this->json('get', "api/todos?filter[status]=abc")
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson(
                [
                    "message" => "The selected filter status is invalid.",
                    "errors" => [
                        "filter.status" => ["The selected filter status is invalid."]
                    ]
                ]
            );
    }

}
