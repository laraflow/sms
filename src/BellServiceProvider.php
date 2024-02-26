<?php

namespace Fintech\Bell;

use Fintech\Bell\Channels\PushChannel;
use Fintech\Bell\Channels\SmsChannel;
use Fintech\Bell\Commands\BellCommand;
use Fintech\Bell\Commands\InstallCommand;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class BellServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bell.php', 'fintech.bell'
        );

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);

    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/bell.php' => config_path('fintech/bell.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'bell');

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/bell'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bell');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/bell'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                BellCommand::class,
            ]);
        }

        $this->extendNotificationChannels();
    }

    private function extendNotificationChannels()
    {
        Notification::extend('sms', function ($app) {
            return $app->make(SmsChannel::class);
        });

        Notification::extend('push', function ($app) {
            return $app->make(PushChannel::class);
        });
    }
}
