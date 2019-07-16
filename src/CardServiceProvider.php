<?php

namespace Swapnilsarwe\NovaIcndbCard;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-icndb-card', __DIR__.'/../dist/js/card.js');
            Nova::style('nova-icndb-card', __DIR__.'/../dist/css/card.css');
        });

        $this->publishes([
            __DIR__.'/config/icndb-card.php' => config_path('icndb-card.php'),
        ]);
    }

    /**
     * Register the card's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('nova-vendor/nova-icndb-card')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/icndb-card.php', 'icndb-card');
    }
}
