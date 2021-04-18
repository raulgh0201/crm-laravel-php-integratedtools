<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


use Closure;
use Illuminate\Http\Request;

class CheckActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()->isActive == 1){
            Auth::logout();
            
            //Message not returning likely because the flashed session data is lost between Logout and redirecting to our login form fomr the built-in Auth methods.
            return redirect('login')->with('error', 'Tu cuenta actualmente no está activa, contacta con un administrador si esto es un error!');
        }

        return $next($request);
    }
}
