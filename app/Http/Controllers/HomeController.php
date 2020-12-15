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
            $Userid=auth()->user()->id;
            $UserArea=auth()->user()->people->area_id;
            $UserNotify=User::query()
                            ->findOrFail($Userid);

            $workpermit=WorkPermit::all();

            $UserNotifyChangeTurn=ChangeTurn::all();

            $UserNotifyVacation = WorkVacation::all();

            return  view('home',
                compact('UserNotify',
                    'workpermit',
                    'UserNotifyChangeTurn',
                    'UserNotifyVacation'));
        }else{
            return view('welcome');
        }
    }

}
