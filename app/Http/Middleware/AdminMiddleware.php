<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if (! auth()->check())// no esta logueado
            return redirect('/');
        if (auth()->user()->role_id ==1 ||
            auth()->user()->role_id ==2 ||
            auth()->user()->role_id ==4 ||
            auth()->user()->role_id ==3 ||
            auth()->user()->role_id ==6)// es admin
            return $next($request);
        return redirect('home');
    }
}
