<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddXContentTypeOptionsHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (method_exists($response, 'header')) {
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('Content-Type', 'text/html; charset=utf-8');
        }
        return $response;
    }
}