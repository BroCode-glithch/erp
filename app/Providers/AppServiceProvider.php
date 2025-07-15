<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\DB;

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
        // Set default string length for database columns to avoid issues with older MySQL versions
        Schema::defaultStringLength(191);  // Set default string length to 191
        // DB::statement("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
    }
}
