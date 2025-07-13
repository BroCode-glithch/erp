<?php

use App\Models\SystemSetting;

if (!function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        // Get all settings
        if (is_null($key)) {
            return SystemSetting::pluck('value', 'key')->toArray();
        }

        // Get setting
        if (is_string($key)) {
            return SystemSetting::get($key, $default);
        }

        // Set multiple settings
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                SystemSetting::set($k, $v);
            }
        }
    }
}
