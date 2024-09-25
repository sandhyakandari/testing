<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }

    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        // if ($request->session()->has('role')) {
        //     return $next($request);
        // } else {
        //     Alert::error('Error', 'Access Denied', 6500);
        //     return redirect()->route('login')->with('error', 'User not registered with us!');
        // }
    }
}
