<?php

namespace OfflineAgency\LaravelEmailChef;

use Illuminate\Support\ServiceProvider;

class LaravelEmailChefServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/email-chef.php' => config_path('email-chef.php'),
            ], 'config');
        }
    }

    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(
            __DIR__.'/../config/email-chef.php',
            'email-chef'
        );

        // Register the main class to use with the facade
        $this->app->singleton('laravel-email-chef', function () {
            return new LaravelEmailChef();
        });
    }
}
