<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\PostCollectionRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends ApiController
{

    public function index(PostCollectionRequest $request): JsonResponse
    {
        $limit = $request->get('limit');
        $collection = !empty($limit) ? Post::filter($request)->simplePaginate($limit) : Post::filter($request)->get();
        return $this->successResponse(PostResource::collection($collection)->response()->getData());
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create($request->all());
        return $this->successResponse($post, 200, 'Post Created Successfully');
    }

    public function show(Post $post)
    {
        return $this->successResponse($post);
    }

    public function update(StorePostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->all());
        return $this->successResponse($post, 200, 'Post Updated Successfully');
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return $this->successResponse([], 200, 'Post Deleted Successfully');
    }
}
