<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName();

        if (auth()->user()->role == USER_ROLE_ALUMNI || auth()->user()->role == USER_ROLE_ADMIN) {
            return $next($request);
        } elseif (auth()->user()->role == USER_ROLE_BOARD_MEMBER && in_array($routeName, [
                'profile',
                'profile_update',
                'add_institution'
            ])) {

        return $next($request);
    }
        abort('403');
    }
}
