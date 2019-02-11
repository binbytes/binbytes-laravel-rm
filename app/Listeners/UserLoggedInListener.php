<?php

namespace App\Listeners;

use App\User;
use Illuminate\Auth\Events\Login;

class UserLoggedInListener
{
    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        if($event->user instanceof User) {
            $attendance = $event->user->firstOrCreateAttendance();

            $attendance->createSession($event->user);
        }
    }
}
