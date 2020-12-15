<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller

{
    function index() {

        if (auth()->check() )//  esta logueado
            return redirect(route('home'));
       return view('welcome');
    }

}
