<?php

namespace Webcasting\Club;

use Illuminate\Support\ServiceProvider;

class ClubServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind('club', function () {
            return new Club();
        });

        $this->publishes([
            __DIR__ . '/config/Club.php' => config_path('Club.php'),
        ]);

        $this->publishesMigrations([
            __DIR__ . '/database/migrations' => database_path('migrations'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'club');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }
}
