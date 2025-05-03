<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Info(
 *     title="Jobify",
 *     description="Thông tin dự án Jobify",
 *     version="1.0.0",
 * )
 *
 * @OA\Server(
 *      url="http://localhost:8040/api",
 *      description="Local server"
 *  )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      description="JWT Bearer token"
 * )
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function responseSuccess(
        mixed $data = [],
        string $message = 'OK',
        string $statusCode = Response::HTTP_OK,
        mixed $cache = null,
        mixed $pagination = []
    ): JsonResponse {
        $response = [
            'data' => $data,
            'message' => $message,
            'status_code' => $statusCode,
        ];

        if (! empty($pagination)) {
            $response['pagination'] = $pagination;
        }

        if (config('app.debug') && ! empty($cache)) {
            $response['cache'] = $cache;
        }

        return response()->json($response, $statusCode);
    }

    public function responseError(
        string $message = '',
        mixed $error = '',
        mixed $statusCode = null
    ): JsonResponse {
        if (! empty($error)) {
            return response()->json([
                'message' => $message,
                'error' => config('app.debug') && is_object($error) && method_exists($error, 'getMessage') ?
                    $error->getMessage() : null,
                'status_code' => $statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR,
            ], $statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => $message,
            'status_code' => $statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR,
        ], $statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function responseUnauthorized(string $message = 'Unauthorized', mixed $error = ''): JsonResponse
    {
        return response()->json([
            'message' => __($message),
            'errors' => is_object($error) && method_exists($error, 'errors') ? $error->errors() : $error,
            'status_code' => Response::HTTP_UNAUTHORIZED,
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param  string  $error
     */
    public function responseValidation(string $message = 'Validation Error', mixed $error = ''): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => is_object($error) && method_exists($error, 'errors') ? $error->errors() : $error,
            'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function responseNotFound(string $message = 'Not Found', mixed $error = ''): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => is_object($error) && method_exists($error, 'errors') ? $error->errors() : $error,
            'status_code' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_NOT_FOUND);
    }

    public function responseSuccessWithNoData(
        string $message = 'OK',
        string $statusCode = Response::HTTP_OK
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'status_code' => $statusCode,
        ], $statusCode);
    }

    public function responseInternalServerError(
        string $message = 'Server Error',
        mixed $error = ''
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'errors' => is_object($error) && method_exists($error, 'errors') ? $error->errors() : $error,
            'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function responseException(mixed $error = ''): JsonResponse
    {
        $statusCode = is_object($error) && method_exists($error, 'getCode') ? $error->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;

        return response()->json([
            'message' => is_object($error) && method_exists($error, 'getMessage') ? $error->getMessage() : $error,
            'status_code' => $statusCode,
        ], $statusCode);
    }

    public function responseMethodNotAllowedHttpException(string $message = 'Method Not Allow', mixed $error = ''): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => is_object($error) && method_exists($error, 'errors') ? $error->errors() : $error,
            'status_code' => Response::HTTP_METHOD_NOT_ALLOWED,
        ], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
