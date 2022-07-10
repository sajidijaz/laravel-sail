<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait RestResponseTrait
{
    protected function successResponse(
        $data,
        int $code = 200,
        ?string $message = null
    ): JsonResponse {
        return response()->json(
            [
                'error' => false,
                'message' => $message,
                'data' => $data
            ],
            $code
        );
    }

    protected function errorResponse(string $message, int $code): JsonResponse
    {
        return response()->json(
            [
                'error' => true,
                'message' => $message,
                'data' => []
            ],
            $code
        );
    }
}
