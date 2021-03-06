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
            'link' => route('details.WorkPermit',$this->workpermit->id),
            'user_id' => $this->workpermit->user_id,
            'name_user'=> $this->workpermit->user->people->names,
            'lastname_user'=> $this->workpermit->user->people->lastnames,
            'time_permit'=>$this->workpermit->timepermit,
            'area_id'=>$this->workpermit->user->people->area_id,
            'type'=> 'permiso_laboral',
            'time'=> Carbon::now()->diffForHumans(),
        ];
    }
}
