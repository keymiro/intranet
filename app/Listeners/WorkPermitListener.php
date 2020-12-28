<?php

namespace App\Listeners;

use App\Notifications\WorkPermitNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class WorkPermitListener implements ShouldQueue
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
        // }); all()->except($event->workpermit->user_id)

        User::all()->except($event->workpermit->user_id)
           ->each(function(User $user)use($event)
            {
                if($event->workpermit->time_permit <=24)
                {
                    if($user->hasRole(['super-admin','coordinador','coordinador-calidad',
                                       'admin','coordinador-rrhh',
                                     ])){
                                        Notification::send($user, new WorkPermitNotification($event->workpermit));
                                         }

                    }elseif($event->workpermit->time_permit >24 && $event->workpermit->time_permit <= 48)
                    {
                        if($user->hasRole(['super-admin','coordinador','director-financiero',
                                    'director-medico','director-financiero','coordinador-calidad',
                                    'admin','coordinador-rrhh',
                                    ])){
                                            Notification::send($user, new WorkPermitNotification($event->workpermit));
                                        }
                            }elseif($event->workpermit->time_permit > 48)
                            {
                                if($user->hasRole('gerencia')){
                                        Notification::send($user, new WorkPermitNotification($event->workpermit));
                                    }
                            }
            });
    }
}
