<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\BroadcastMessage;

trait Broadcaster {

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'read_at' => null,
            'type' => self::class,
            'data' => $this->toArray($notifiable)
        ]);
    }
}