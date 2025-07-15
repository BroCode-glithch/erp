<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
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
    public function boot()
    {
        // Load settings from the database or configuration
        $appearance = [
            'direction' => setting('appearance.direction', 'ltr'),
            'language'  => setting('appearance.language', 'en'),
        ];

        // Set locale
        App::setLocale($appearance['language']);

        // Share settings to all views
        View::share('appearance', $appearance);
    }
}
