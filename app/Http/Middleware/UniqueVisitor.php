<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UniqueVisitors;
use Illuminate\Support\Facades\Log;

class UniqueVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {    
        $cookieN='visit';
        $cookieVal=Cookie::get($cookieN);
         if(!$cookieVal){
            $ipAddress=$request->ip();
            Cookie::queue($cookieN,'visited','0');
            $vis=UniqueVisitors::where('ip_address',$ipAddress)->first();
            if(!$vis){
                UniqueVisitors::create(['ip_address'=>$ipAddress]);
            }
        }
        return $next($request);

    }
}
