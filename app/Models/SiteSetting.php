<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember(
            "site_setting:{$key}",
            now()->addHours(24),
            fn() => static::where('key', $key)->value('value') ?? $default
        );
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget("site_setting:{$key}");

        $group = static::where('key', $key)->value('group');
        if ($group) {
            Cache::forget("site_settings_group:{$group}");
        }

        Cache::forget('homepage_data');
    }

    public static function group(string $group): array
    {
        return Cache::remember(
            "site_settings_group:{$group}",
            now()->addHours(24),
            fn() => static::where('group', $group)
                ->pluck('value', 'key')
                ->toArray()
        );
    }

    public static function bustAllCache(): void
    {
        static::all()->each(function ($setting) {
            Cache::forget("site_setting:{$setting->key}");
        });

        $groups = static::distinct()->pluck('group');
        foreach ($groups as $group) {
            Cache::forget("site_settings_group:{$group}");
        }

        Cache::forget('homepage_data');
    }
}
