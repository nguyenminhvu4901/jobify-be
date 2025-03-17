<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class SanitizeInput
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sanitized = $this->sanitizeData($request->all());
        $request->merge($sanitized);

        return $next($request);
    }

    /**
     *
     * @param mixed $data
     * @return mixed
     */
    private function sanitizeData(mixed $data): mixed
    {
        if (is_string($data)) {
            return trim(strip_tags($data));
        } elseif (is_numeric($data)) {
            return $data + 0;
        } elseif (is_array($data)) {
            return array_map([$this, 'sanitizeData'], $data);
        } elseif ($data instanceof UploadedFile) {
            return $data;
        }

        return $data;
    }
}
