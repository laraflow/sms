<?php

namespace Laraflow\Sms;

use Illuminate\Support\Facades\Config;
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
            __DIR__ . '/../config/sms.php',
            'sms'
        );

        $this->extendLoggerChannel();
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/sms.php' => config_path('sms.php'),
        ], 'sms-config');

        $this->extendNotificationChannel();

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/../view', 'sms');
    }

    /**
     * Adding "sms" as notification channel insist of
     * the class name as drivers will get swapped under the hood.
     */
    private function extendNotificationChannel(): void
    {
        Notification::extend('sms', function ($app) {
            return $app->make(SmsChannel::class);
        });
    }

    private function extendLoggerChannel(): void
    {
        Config::set('logging.channels.sms', [
            'driver' => 'daily',
            'path' => storage_path('logs/sms.log'),
            'level' => 'info',
            'days' => 14,
            'replace_placeholders' => true,
        ]);
    }
}
