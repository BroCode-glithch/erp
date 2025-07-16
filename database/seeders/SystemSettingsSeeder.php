<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SEEDING SYSTEM SETTINGS
        $settings = [
            ['key' => 'general.site_name', 'value' => env('APP_NAME')],
            ['key' => 'general.system_email', 'value' => 'info@erp.com'],
            ['key' => 'apppearance.direction', 'value' => 'ltr'], // or 'rtl' for right-to-left languages
            ['key' => 'appearance.language', 'value' => 'en'],
            ['key' => 'general.contact_phone', 'value' => '080-8177-0338'],
            ['key' => 'general.contact_address', 'value' => '123 ERP Street, Lagos, Nigeria'],
            ['key' => 'general.site_logo', 'value' => 'settings/logo.png'], // Default logo path
            ['key' => 'general.favicon', 'value' => 'settings/favicon.ico'], // Default favicon path
            ['key' => 'general.timezone', 'value' => 'Africa/Lagos'], // Adjust as necessary
            ['key' => 'general.currency_symbol', 'value' => '₦'],
            ['key' => 'general.date_format', 'value' => 'Y-m-d'],
            ['key' => 'general.time_format', 'value' => 'H:i:s'],
            ['key' => 'general.maintenance_mode', 'value' => false], // true or false
        ];

        foreach ($settings as $setting) {
            SystemSetting::create($setting);
        }

        // output a message
        $this->command->info('System settings seeded successfully!');
    }
}
