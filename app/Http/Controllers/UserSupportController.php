<?php

namespace App\Http\Controllers;

use App\UserSupport;
use Illuminate\Http\Request;

class UserSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user_support_index')->only('index');
    }
    public  function index()
    {
        $usersopport= UserSupport::paginate(20);
        return view('forms.siau.user_support_index'
        ,compact('usersopport'));
    }
}
