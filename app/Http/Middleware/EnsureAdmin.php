<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class EnsureAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
        if (Auth::check()) {
           
            $user = Auth::user();
            if($user->role == 1)
                return $next($request);
            else 
                return redirect()->route('home')->withErrors([
            'access_denied' => 'Bạn không có quyền truy cập vào trang này.',
        ]);
                       
        }           
    }
}
