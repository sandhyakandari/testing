<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class AcademyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('role') && $request->session()->has('id')) {
            if (session('role') == 'Academy') {
                return $next($request);
            } else {
                Alert::error('Error', 'Not allowed to visit this page.', 6500);
                return redirect()->back();
            }
        } else {
            Alert::error('Error', 'Access Denied', 6500);
            return redirect()->route('home');
        }
    }
}
