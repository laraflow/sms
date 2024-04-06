<?php

namespace Laraflow\Sms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/sms.php', 'sms'
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/sms.php' => config_path('sms.php'),
        ]);

        $this->extendNotificationChannel();
    }

    private function extendNotificationChannel(): void
    {
        \Illuminate\Support\Facades\Notification::extend('sms', function ($app) {
            return $app->make(SmsChannel::class);
        });
    }
}
