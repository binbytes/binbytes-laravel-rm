<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\User::class => \App\Policies\UserPolicy::class,
        \App\Client::class => \App\Policies\ClientPolicy::class,
        \App\Project::class => \App\Policies\ProjectPolicy::class,
        \App\Holiday::class => \App\Policies\HolidayPolicy::class,
        \App\Leave::class => \App\Policies\LeavePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('clients', \App\Client::class);
        Gate::resource('users', \App\User::class);
        Gate::resource('projects', \App\Project::class);
        Gate::resource('holidays', \App\Holiday::class);
        Gate::resource('leaves', \App\Leave::class);
    }
}
