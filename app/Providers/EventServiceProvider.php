<?php

namespace App\Providers;

use App\Events\HolidayAdded;
use App\Events\UserSignIn;
use App\Listeners\HolidayAddedListener;
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
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\UserLoggedInListener::class,
        ],
        \App\Events\HolidayAddedHolidayAdded::class => [
            \App\Listeners\HolidayAddedListener\HolidayAddedListener::class,
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
