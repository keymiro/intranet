<?php

namespace App\Http\Controllers;
use App\Archive;
use App\ChangeTurn;
use App\WorkVacation;
use App\User;
use App\WorkPermit;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->check())
        {
          return  view('home');

        }else{
            return view('welcome');
        }
    }

}
