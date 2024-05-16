<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades;

class AppServiceProvider extends ServiceProvider
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
        $this->app->singleton('AuctionVege', function () {
            return new \App\AuctionVege();
        });

        Facades\View::composer('*', function (View $view) {
            $view->with([
                'app_name' => 'HEllo !!',
            ]);
        });
    }
}
