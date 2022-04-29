<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class IsUserVerifyEmail
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
   
        if(!auth()->guard('web')->user()->email_verified)
        {
            Auth::guard('web')->logout();
            return redirect()->route('homepage')->with(['error' => 'البريد الاكتروني غير  مفعل اذهب الي بريدك الاكتروني وقم بالتفعيل '])->withInput();
        }
        return $next($request);
    }


}
