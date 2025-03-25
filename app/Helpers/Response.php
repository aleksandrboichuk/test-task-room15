<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

class Response
{
    public static function success(array $data): JsonResponse
    {
        return response()->json($data);
    }

    public static function badRequest(string $message = 'Bad Request'): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], 400);
    }

    public static function failed(string $message = 'Internal Server Error'): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], 500);
    }

    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], 401);
    }

    public static function notFound(string $message = 'Not found'): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], 404);
    }

    public static function validationError(MessageBag $validationErrors): JsonResponse
    {
        return response()->json([
            'errors' => $validationErrors,
        ], 422);
    }
}
