<?php

namespace App\Notifications;

use App\Modules\Timeline;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomTimelineNotification extends Notification
{
//    use Queueable;

    public $data=[];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Timeline $customData)
    {
        $this->data=$customData;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return  [
            'type'=>$this->data->getType(),
            'icon'=>$this->data->icon,
            'title'=>$this->data->title,
            'title_info'=>$this->data->title_info,
            'title_route'=>$this->data->title_route,    'title_link'=>$this->data->title_link,
            'content'=>$this->data->content,
            'button_text'=>$this->data->button_text,
            'button_class'=>$this->data->button_class,
            'button_route'=>$this->data->button_route,   'button_link'=>$this->data->button_link,
        ];
    }
}
