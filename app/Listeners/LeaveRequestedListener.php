<?php

namespace App\Listeners;

use App\User;
use Notification;
use App\Notifications\LeaveRequested;

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
