<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
            $types = ['admin'];
            foreach ($types as $type) {
                if (auth()->guard($type)->check()) {
                    $view->with('guardName', $type);
                }
            }
        });
    }
}
