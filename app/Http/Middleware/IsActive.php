<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsActive
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
        // dd(auth()->check(), $request->expectsJson());
        if (auth()->check()) {
            if (auth()->user()->is_active) {
                return $next($request);
            }
            abort(401, __('unauthorized'));
        }
        return $next($request);
        // $user = auth()->check() ? auth()->user() : User::where('username', $request->authLogin)->first();
        // if ($user?->is_active || $user == null) {
        //     return $next($request);
        // }
    }
}
