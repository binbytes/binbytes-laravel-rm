<?php

namespace App\Listeners;

use App\User;
use Notification;
use App\Events\HolidayAdded;

class HolidayAddedListener
{
    /**
     * Handle the event.
     *
     * @param HolidayAdded $event
     * @return void
     */
    public function handle(HolidayAdded $event)
    {
        Notification::send(User::all(), new \App\Notifications\HolidayAdded($event->holiday));
    }
}
