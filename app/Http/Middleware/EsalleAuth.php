<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsalleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('secure') && session('secure')== 'yes'){
            if (!session()->has('user_type')) {
                return redirect('/');
            }
            else{
                 return $next($request);
            }
        }
        else{
            if (!session()->has('user_type')) {
                return redirect('/');
            }
            else{
                 return $next($request);
            }
        }
        
       
    }
}
