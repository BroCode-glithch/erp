<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system_settings';

    protected $fillable = ['key', 'value'];
    public $timestamps = false;

    public static function get($key, $default = null)
    {
        // Attempt to retrieve the setting from the cache
        if (Cache::has("setting.{$key}")) {
            return Cache::get("setting.{$key}");
        }

        // If not in cache, retrieve from the database and cache it
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            return optional(static::where('key', $key)->first())->value ?? $default;
        });
    }

    public static function set($key, $value)
    {
        // Update or create the setting in the database
        static::updateOrCreate(
            ['key' => $key],
             ['value' => $value],
        );
        
        Cache::forget("setting.{$key}");
    }
}
