<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('layouts.manager', function ($view) {
            $menus = auth()->user()->role->resources()->where('is_menu', true)->get();
            $view->with('menus', $menus);
        });
    }
}
