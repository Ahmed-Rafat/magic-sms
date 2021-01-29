<?php

namespace AR\MagicSms\Providers;

use Illuminate\Support\ServiceProvider;

class MagicSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('magic-sms.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'magic-sms');

        // Register the main class to use with the facade
        $this->app->singleton('magic-sms', function () {
            return new MagicSms;
        });
    }
}
