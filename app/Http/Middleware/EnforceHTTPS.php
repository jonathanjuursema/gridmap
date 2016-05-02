<?php

namespace App\Http\Middleware;

use Closure;

class EnforceHTTPS
{
    /**
     * This middleware forces the entire application to use SSL. We like that, because it's secure.
     *
     * Shamelessly copied from: http://stackoverflow.com/questions/28402726/laravel-5-redirect-to-https
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}