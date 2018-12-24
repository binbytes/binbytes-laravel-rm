<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\UserLoggedInListener::class,
        ],
        \App\Events\HolidayAdded::class => [
            \App\Listeners\HolidayAddedListener::class,
        ],
        \App\Events\LeaveRequested::class => [
            \App\Listeners\LeaveRequestedListener::class,
        ],
        \App\Events\LeaveApproval::class => [
            \App\Listeners\LeaveApprovalListener::class,
        ],
        \App\Events\SalaryPaid::class => [
            \App\Listeners\SalaryPaidListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
