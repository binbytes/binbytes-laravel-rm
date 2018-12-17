<?php

namespace App\Listeners;

use App\Notifications\LeaveRequested;
use App\User;
use Notification;

class LeaveRequestedListener
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
     * @param \App\Events\LeaveRequested $event
     * @return void
     */
    public function handle(\App\Events\LeaveRequested $event)
    {
        Notification::send(
            User::admin()->get(),
            new LeaveRequested($event->leave)
        );
    }
}
