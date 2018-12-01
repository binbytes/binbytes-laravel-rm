<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeDirectives();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register our custom blade directives
     */
    protected function registerBladeDirectives()
    {
        \Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        \Blade::if('notAdmin', function () {
            return auth()->check() && !auth()->user()->isAdmin();
        });
    }
}
