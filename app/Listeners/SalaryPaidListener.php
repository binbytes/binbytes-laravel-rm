<?php

namespace App\Listeners;

use App\Events\SalaryPaid;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
