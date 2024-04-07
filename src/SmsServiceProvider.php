<?php

namespace Laraflow\Sms;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sms.php', 'sms'
        );
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/sms.php' => config_path('sms.php'),
        ]);

        $this->extendNotificationChannel();
    }

    /**
     * Adding "sms" as notification channel insist of
     * the class name as drivers will get swapped under the hood.
     *
     * @return void
     */
    private function extendNotificationChannel(): void
    {
        Notification::extend('sms', function ($app) {
            return $app->make(SmsChannel::class);
        });
    }
}
