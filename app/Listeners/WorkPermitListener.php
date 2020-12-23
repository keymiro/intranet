<?php

namespace App\Listeners;

use App\Notifications\WorkPermitNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class WorkPermitListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // User::all()->except($workpermit->user_id)
        // ->each(function(User $user) use ($workpermit)
        // {
        //  $user->notify(new WorkPermitNotification($workpermit));
        // });
        User::all()
            ->except($event->workpermit->user_id)
            ->each(function(User $user)use($event)
            {
                Notification::send($user, new WorkPermitNotification($event->workpermit));
            });
    }
}
