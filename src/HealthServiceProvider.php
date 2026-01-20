<?php

namespace IFresh\PackageHealth;

use IFresh\PackageHealth\Commands\SendPackageStatusCommand;
use Illuminate\Support\ServiceProvider;

class HealthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/health.php' => config_path('health.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                SendPackageStatusCommand::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/health.php', 'health'
        );
    }
}
