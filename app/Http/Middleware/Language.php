<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->hasHeader('X-localization')) {
            $lang = in_array($request->header('X-localization'), config('app.lang'))
                ? $request->header('X-localization')
                : config('app.locale');
            app()->setLocale($lang);
        }

        return $next($request);
    }
}
