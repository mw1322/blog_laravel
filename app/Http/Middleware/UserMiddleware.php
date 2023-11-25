<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            if (Auth::user()->role_as == '0') { //1 = Admin && 0 = normal user
                return $next($request);
            } else {
                return redirect("/home")->with('status', 'Access Denied! As you are not an Admin');
            }
        } else {
            return redirect('/login')->with('status', 'Please Login First');
        }
    }
}
