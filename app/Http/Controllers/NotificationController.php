<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $readnotify=auth()->user()->readNotifications;
        $unreadnotify=auth()->user()->unreadNotifications;
        return view('notifications.index',
        compact('readnotify','unreadnotify'));

    }
    public function readAllNotifications()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('notification','Se han marcado todas las notificaciones como leídas');
    }
    public function readNotification($id)
    {

        auth()->user()->unreadNotifications->where('id',$id)->markAsRead();
        return back()->with('notification','Se ha marcado la notificación como leída');
    }
    public function DeleteNotification($id)
    {
       $n = auth()->user()->readNotifications->where('id',$id)->first();
       $n->delete();
        return back()->with('notification','Se ha eliminado la notificación');
    }

}
