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

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return array_merge([
            'mail', 'database'
        ], config('rm.broadcast_notification') ? 'broadcast' : []);
    }
}