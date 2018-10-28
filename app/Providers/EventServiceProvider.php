<?php

namespace App\Providers;

use App\Events\HolidayAdded;
use App\Events\LeaveApproval;
use App\Events\LeaveRequested;
use App\Events\UserSignIn;
use App\Listeners\HolidayAddedListener;
use App\Listeners\LeaveApprovalListener;
use App\Listeners\LeaveRequestedListener;
use App\Listeners\UserLoggedInListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserSignIn::class => [
            UserLoggedInListener::class,
        ],
        HolidayAdded::class => [
            HolidayAddedListener::class,
        ],
        LeaveRequested::class => [
            LeaveRequestedListener::class,
        ],
        LeaveApproval::class => [
            LeaveApprovalListener::class,
        ]
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
