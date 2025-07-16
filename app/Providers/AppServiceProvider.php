<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
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

        if (Schema::hasTable('system_settings')) {
            $settings = SystemSetting::pluck('value', 'key')->toArray();

            // Merge with defaults
            $settings = array_merge([
                'general.site_name' => config('app.name'),
                'general.system_email' => config('mail.from.address'),
            ], $settings);

            $settings = collect($settings)->mapWithKeys(fn($v, $k) => [str_replace('.', '_', $k) => $v])->toArray();

            view()->share('settings', $settings);
        }
    }
}