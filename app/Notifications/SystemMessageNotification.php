<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class SystemMessageNotification extends Notification
{
    public function __construct(
        public string $message,
        public string $type,
        public ?string $link
    )
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        if($this->type === 'system_message'){
            return [
                'message' => $this->message,
                'type' => 'system_message',
                'link' => $this->link,
                'icon' => 'fa fa-info-circle',
            ];
        }

        if($this->type === 'success'){
            return [
                'message' => $this->message,
                'type' => 'success',
                'link' => $this->link,
                'icon' => 'fa fa-info-circle',
            ];
        }

        if($this->type === 'warning'){
            return [
                'message' => $this->message,
                'type' => 'warning',
                'link' => $this->link,
                'icon' => 'fa fa-info-circle',
            ];
        }



    }

    public function toArray($notifiable): array
    {
        return [

        ];
    }
}
