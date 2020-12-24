<?php

namespace App\Notifications;

use App\WorkPermit;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WorkPermitNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(WorkPermit $workPermit)
    {
        $this->workpermit = $workPermit;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' =>'Permiso Laboral',
            'workpermit_id' => $this->workpermit->id,
            'user_id' => $this->workpermit->user_id,
            'name_user'=> $this->workpermit->user->people->names,
            'lastname_user'=> $this->workpermit->user->people->lastnames,
            'datepermit'=> $this->workpermit->datepermit,
            'timepermit'=> $this->workpermit->timepermit,
            'rdate'=> $this->workpermit->rdate,
            'time'=> Carbon::now()->diffForHumans(),

        ];
    }
}
