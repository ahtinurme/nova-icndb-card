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
    public function boot(): void
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function () {
            Nova::script('nova-icndb-card', __DIR__.'/../dist/js/card.js');
        });
    }

    /**
     * Register the card's routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('nova-vendor/nova-icndb-card')
                ->group(__DIR__.'/../routes/api.php');
    }
}
