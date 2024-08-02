<?php

namespace App\Providers;

use App\Models\MenuItem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['navigation.navbar', 'navigation.mobile'], function($view) {
            $items = MenuItem::where('type', 'nav')->orderBy('order')->get()->groupBy('parent_id');

            $view->with(['navItems' => $items]);
        });
    }
}
