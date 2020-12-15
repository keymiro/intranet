<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param
     * @return string|null
     */
    protected function redirectTo($request)
    {

        /*if (Auth::guard($guard)->check() && auth()->user()->active == 0) {

            // usuario con sesión iniciada pero inactivo

            // cerramos su sesión
            Auth::guard()->logout();

            // invalidamos su sesión
            $request->session()->invalidate();
        // redireccionamos a donde queremos
             redirect('/ruta-para-usuario-desactivado');
        */
        if (!$request->expectsJson()) {
            return route('index');
        }
    }




}
