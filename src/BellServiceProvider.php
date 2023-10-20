<?php

namespace Fintech\Bell;

use Illuminate\Support\ServiceProvider;
use Fintech\Bell\Commands\InstallCommand;
use Fintech\Bell\Commands\BellCommand;

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
            __DIR__.'/../config/bell.php', 'fintech.bell'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/bell.php' => config_path('fintech/bell.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'bell');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/bell'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bell');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/bell'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                BellCommand::class,
            ]);
        }
    }
}
