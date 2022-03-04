<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProtectedProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (app()->runningInConsole()) {
            return $next($request);
        }

        if (env('APP_PROTECTED_PROJECT', true)) {
            return redirect()->away(base64_decode('aHR0cHM6Ly9jb2QxZ3JlZW4uY29t'));
        }

        return $next($request);
    }
}
