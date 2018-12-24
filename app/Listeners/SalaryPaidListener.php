<?php

namespace App\Listeners;

use App\User;
use App\Events\SalaryPaid;

class SalaryPaidListener
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
     * @param  SalaryPaid  $event
     * @return void
     */
    public function handle(SalaryPaid $event)
    {
        User::find($event->salary->user_id)->notify(
            new \App\Notifications\SalaryPaid(
                $event->salary
            )
        );
    }
}
