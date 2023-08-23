<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLoginStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  if (Auth::check()) {

        //     if ($request->is('login', 'register')) {
        //         return redirect()->back()->with('warning', 'Harap Logout Terlebih Dahulu');
        //     }

        //     return $next($request);

        // } else {
        //     return redirect('/login')->with('error', 'Harap Login Terlebih Dahulu');
        // }
            return $next($request);

    }
}
