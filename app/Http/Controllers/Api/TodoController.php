<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends ApiController
{

    public function index(Request $request): JsonResponse
    {
        $request->validate([
                               'page' => 'filled|integer|min:1',
                               'limit' => 'filled|integer|between:1,100',
                           ]);
        $limit = $request->get('limit');
        if ($limit) {
            $collection = Todo::simplePaginate($limit);
        } else {
            $collection = Todo::all();
        }
        return $this->successResponse(TodoResource::collection($collection)->response()->getData());
    }

    public function store(StoreTodoRequest $request): JsonResponse
    {
        $todo = Todo::create($request->all());
        return $this->successResponse($todo, 200, 'Todo Created Successfully');
    }

    public function show(Todo $todo): JsonResponse
    {
        return $this->successResponse($todo);
    }

    public function update(StoreTodoRequest $request, Todo $todo): JsonResponse
    {
        $todo->update($request->all());
        return $this->successResponse($todo, 200, 'Todo Updated Successfully');
    }

    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();
        return $this->successResponse([], 200, 'Todo Deleted Successfully');
    }
}
