<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * @return string|void|null
     */
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {
            return route('auth.unauthorized');
        }
    }
}
