<?php

namespace App\Http\Middleware;

use Closure;

class SetCharsetMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'application/json') !== false) {
            $response->header('Content-Type', 'application/json; charset=utf-8');
        }

        return $response;
    }
}
