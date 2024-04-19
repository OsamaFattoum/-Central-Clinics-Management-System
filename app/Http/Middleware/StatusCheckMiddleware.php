<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StatusCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!Auth::guard('admin')->check()){
            if(Auth::user()->status == false){
                $guardName = Auth::guard()->name;

                Auth::guard($guardName)->logout();

                $request->session()->invalidate();
        
                $request->session()->regenerateToken();
    

                session()->flash('status_unathorized');
                $routeLogin = $guardName == 'doctor' ? 'doctor.login' : 'facility.login';
                return response()->redirectToRoute($routeLogin);
            }
        }
        
        return $next($request);
    }
}
