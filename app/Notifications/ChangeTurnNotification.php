<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeTurnNotification extends Notification 
{
    use Queueable;
   public  $changeturn;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $changeturn)
    {
        $this->changeturn= $changeturn;
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
            'title' =>'Cambio de turno',
            'link' => route('ChangeTurn.detailsc',$this->changeturn->id),
            'user_id' => $this->changeturn->user_id,
            'name_user'=> $this->changeturn->user->people->names,
            'lastname_user'=> $this->changeturn->user->people->lastnames,
            'type'=> 'cambio_de_turno',
            'time'=> Carbon::now()->diffForHumans(),
        ];
    }
}
