<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class HeroSetting extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'title_accent',
        'description',
        'stat_1_value',
        'stat_1_label',
        'stat_2_value',
        'stat_2_label',
        'stat_3_value',
        'stat_3_label',
        'button_1_text',
        'button_1_url',
        'button_2_text',
        'button_2_url',
        'button_2_anchor',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug dari title sebelum save
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title ?? 'hero-settings-' . time());
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->title);
            }
        });

        // Clear cache setelah update
        static::updated(function ($model) {
            self::clearHeroCache();
        });

        // Clear cache setelah create
        static::created(function ($model) {
            self::clearHeroCache();
        });

        // Clear cache setelah delete
        static::deleted(function ($model) {
            self::clearHeroCache();
        });
    }

    /**
     * Clear hero settings cache
     */
    public static function clearHeroCache()
    {
        Cache::forget('hero_settings_cache');
        Cache::forget('hero_settings_' . encrypt('hero-settings'));
    }

    /**
     * Get route key name (use slug instead of id)
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get atau create hero settings (singleton pattern)
     * Selalu ambil data fresh dari database, tanpa cache
     */
    public static function settings($bypassCache = true)
    {
        // Query builder tanpa cache - force fresh dari database
        $query = self::where('id', 1);

        // Bypass Laravel query caching jika di-set
        if ($bypassCache) {
            $query->toBase(); // Convert to base query
        }

        $setting = $query->first();

        if (!$setting) {
            // Jika tidak ada, create dengan data default
            $setting = self::create([
                'id' => 1,
                'slug' => 'arsip-literasi',
                'title' => 'Arsip & Literasi',
                'title_accent' => 'untuk Semarang',
                'description' => 'Portal informasi publik Dinas Arsip dan Perpustakaan Kota Semarang. Akses arsip digital, katalog perpustakaan, infografis, statistik layanan, dan dokumen resmi secara mudah, terbuka, dan akuntabel.',
                'stat_1_value' => '8.240',
                'stat_1_label' => 'Arsip Digital',
                'stat_2_value' => '42.680',
                'stat_2_label' => 'Koleksi Buku',
                'stat_3_value' => '97,8%',
                'stat_3_label' => 'Tingkat Kepuasan',
                'button_1_text' => 'Ajukan Permohonan',
                'button_1_url' => '#',
                'button_2_text' => 'Jelajahi Layanan',
                'button_2_url' => '#layanan',
                'button_2_anchor' => 'layanan',
            ]);
        }

        // Refresh data dari database untuk memastikan fresh
        if ($setting) {
            $setting->refresh();
        }

        return $setting;
    }
}
