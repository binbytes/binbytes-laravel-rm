<?php

namespace App\Listeners;

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
        $attendance = $event->user->firstOrCreateAttendance();

        $attendance->createSession($event->user);
    }
}
