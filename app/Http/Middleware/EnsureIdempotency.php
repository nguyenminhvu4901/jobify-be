<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class EnsureIdempotency
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     * @throws InvalidArgumentException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return $next($request);
        }

        $key = $request->header('Idempotency-Key');
        if (!$key) {
            return response()->json(['error' => 'Idempotency-Key header is required'], 400);
        }

        $baseCacheKey = 'idempotency:' . $request->method() . ':' . md5($request->url() . ':' . $key);

        $payload = $request->all();
        $normalizedPayload = $this->normalizePayload($payload);
        $payloadHash = md5(json_encode($normalizedPayload));

        $cache = redisCacheDB();

        try {
            $cachedData = $cache->get($baseCacheKey);
        } catch (\Exception $e) {

            Log::error('Idempotency Cache get error', [
                'key' => $baseCacheKey,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $cachedData = null;
        }

        if ($cachedData) {
            if (isset($cachedData['payload_hash']) && $cachedData['payload_hash'] === $payloadHash) {

                return response()->json(
                    $cachedData['response_data'],
                    $cachedData['status']
                )->withHeaders($cachedData['headers']);
            }
        }

        $response = $next($request);

        if ($response instanceof JsonResponse) {
            try {
                $cache->put($baseCacheKey, [
                    'payload_hash' => $payloadHash,
                    'response_data' => $response->getData(true),
                    'status' => $response->getStatusCode(),
                    'headers' => $response->headers->all(),
                ], now()->addMinutes(5));
            } catch (\Exception $e) {

                Log::error('Idempotency Cache put error', [
                    'key' => $baseCacheKey,
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }

        return $response;
    }

    /**
     * @param array $payload
     * @return array
     */
    private function normalizePayload(array $payload): array
    {
        ksort($payload);
        foreach ($payload as &$value) {
            if (is_array($value)) {
                $value = $this->normalizePayload($value);
            }
        }
        return $payload;
    }

}
