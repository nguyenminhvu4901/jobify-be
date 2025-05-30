<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckGuest;
use App\Http\Middleware\EnsureIdempotency;
use App\Http\Middleware\Language;
use App\Http\Middleware\SanitizeInput;
use App\Http\Middleware\SetContextUrl;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            Language::class,
            SetContextUrl::class,
            SanitizeInput::class
        ]);
        $middleware->alias([
            'auth' => Authenticate::class,
            'guest' => CheckGuest::class,
            'idempotency' => EnsureIdempotency::class
        ]);
        $middleware->group('api', [
            StartSession::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Too Many Requests',
                    'status_code' => 429
                ], 429);
            }
        });
    })->create(
    );
