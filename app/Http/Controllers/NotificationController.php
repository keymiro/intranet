<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
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
        return back()->with('notification','Se han marcado todas las notificaciones como léidas');
    }

}
