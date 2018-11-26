<?php

namespace App\Listeners;

use App\Events\LeaveApproval;
use App\Leave;
use App\User;
use Notification;

class LeaveApprovalListener
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
     * @param LeaveApproval $event
     * @return void
     */
    public function handle(LeaveApproval $event)
    {
        User::find($event->leave->user_id)->notify(new \App\Notifications\LeaveApproval($event->leave));
    }
}
