<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Model
{
    protected $fillable = ['key', 'value'];
    public $timestamps = false;

    public static function get($key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            return optional(static::where('key', $key)->first())->value ?? $default;
        });
    }

    public static function set($key, $value)
    {
        static::updateOrCreate(
            ['key' => $key],
             ['value' => $value],
        );
        
        Cache::forget("setting.{$key}");
    }
}
