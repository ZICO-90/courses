<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth ;
class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , $guard = null)
    {    

            if ( Auth::guard('admin')->check()) {
           
                return $next($request);
             
                       
            }else{
              
                return redirect()->route('login.show.admin');    
            }
           
       
            return $next($request);
    }
}
