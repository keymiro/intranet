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
                $time_permit=$event->workpermit->timepermit;
                $area_id =$event->workpermit->user->people->area_id;
                if($time_permit <=24)
                {
                    if($user->hasRole(['super-admin','coordinador','coordinador-calidad',
                                       'admin','coordinador-rrhh',]) && $area_id==$user->people->area_id)
                    {
                         Notification::send($user, new WorkPermitNotification($event->workpermit));
                    }
                    }elseif($time_permit >24 && $time_permit <= 48)
                    {
                        //   Manda la notificacion al coordinador
                            if($user->hasRole(['super-admin','coordinador','coordinador-calidad',
                                       'admin','coordinador-rrhh',]) && $area_id==$user->people->area_id)
                            {
                                Notification::send($user, new WorkPermitNotification($event->workpermit));
                            }
                        // valida si el funcionario es administrativo o asistencial
                            if($event->workpermit->user->type_func ==1)
                            {
                                    if($user->hasRole('director-financiero')){
                                        Notification::send($user, new WorkPermitNotification($event->workpermit));
                                        }
                            }else{
                                    if($user->hasRole('director-medico')){
                                        Notification::send($user, new WorkPermitNotification($event->workpermit));
                                        }
                            }
                        if($user->hasRole(['super-admin','coordinador',
                                    'director-medico','director-financiero','coordinador-calidad',
                                    'admin','coordinador-rrhh',
                                    ])){
                                        Notification::send($user, new WorkPermitNotification($event->workpermit));
                                        }
                            }elseif($time_permit  > 48)
                            {
                                    //   Manda la notificacion al coordinador
                                if($user->hasRole(['super-admin','coordinador','coordinador-calidad',
                                       'admin','coordinador-rrhh',]) && $area_id==$user->people->area_id)
                                {
                                    Notification::send($user, new WorkPermitNotification($event->workpermit));
                                }
                                // valida si el funcionario es administrativo o asistencial
                                if($event->workpermit->user->type_func ==1)
                                {
                                        if($user->hasRole('director-financiero')){
                                            Notification::send($user, new WorkPermitNotification($event->workpermit));
                                            }
                                }else{
                                        if($user->hasRole('director-medico')){
                                            Notification::send($user, new WorkPermitNotification($event->workpermit));
                                            }
                                }

                                //   Manda la notificacion al gerente
                                if($user->hasRole(['gerencia'])){
                                        Notification::send($user, new WorkPermitNotification($event->workpermit));
                                    }
                            }
            });
    }
}
