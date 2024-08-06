<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess(mixed $data, string $message = 'OK'): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status_code' => JsonResponse::HTTP_OK
        ], JsonResponse::HTTP_OK);
    }

    public function responseError($error, string $statusCode = JsonResponse::HTTP_NOT_FOUND): JsonResponse
    {
        if ($error instanceof ModelNotFoundException) {
            return response()->json([
                'data' => [],
                'message' => 'Not Found',
                'status_code' => JsonResponse::HTTP_NOT_FOUND
            ], JsonResponse::HTTP_NOT_FOUND);
        } else {
            if (is_string($error)) {
                return response()->json([
                    'message' => $error,
                    'status_code' => $statusCode
                ], $statusCode);
            } else {
                return response()->json([
                    'message' => $error->getMessage(),
                    'status_code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function responseUnauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status_code' => JsonResponse::HTTP_UNAUTHORIZED
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function responseNotFound(string $message = 'Not Found'): JsonResponse
    {
        return response()->json([
            'data' => [],
            'message' => $message,
            'status_code' => JsonResponse::HTTP_NOT_FOUND
        ], JsonResponse::HTTP_NOT_FOUND);
    }
}