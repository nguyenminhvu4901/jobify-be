<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckGuest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
           \App\Http\Middleware\Language::class
        ]);
        $middleware->alias([
            'auth' => Authenticate::class,
            'guest' => CheckGuest::class
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
