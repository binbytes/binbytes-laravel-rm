<?php

namespace App\Listeners;

use App\Events\UserSignIn;

class UserLoggedInListener
{
    /**
     * Handle the event.
     *
     * @param UserSignIn $event
     * @return void
     */
    public function handle(UserSignIn $event)
    {
        $attendance = $event->user->firstOrCreateAttendance();

        $attendance->createSession($event->user);
    }
}
