<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewsNotification extends Notification
{
    use Queueable;

    public $user;
    public $message;


    public function __construct($user,$message)
    {
        $this->user = $user;
        $this->message = $message;
    }


    public function via($notifiable)
    {
        return ['database'];
    }





    public function toDatabase($notifiable)
    {
        return [
            'title'=>'هناك تقييم من '.$this->user,
            'body'=>$this->message
        ];
    }
}
