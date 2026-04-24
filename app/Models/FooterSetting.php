<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class FooterSetting extends Model
{
    protected $fillable = [
        'slug',
        'brand_name',
        'tagline',
        'social_facebook',
        'social_instagram',
        'social_youtube',
        'social_twitter',
        'cert_1_text',
        'cert_1_icon',
        'cert_2_text',
        'cert_2_icon',
        'contact_address',
        'contact_phone',
        'contact_fax',
        'contact_email',
        'contact_hours',
        'section_1_menu',
        'section_2_menu',
        'section_3_menu',
        'footer_copyright',
    ];

    // Cukup ini saja — $casts sudah handle encode/decode otomatis
    protected $casts = [
        'section_1_menu' => 'array',
        'section_2_menu' => 'array',
        'section_3_menu' => 'array',
    ];

    // HAPUS getAttribute() override
    // HAPUS setAttribute() override

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->brand_name ?? 'footer-settings-' . time());
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('brand_name') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->brand_name);
            }
        });

        static::updated(fn($model) => self::clearFooterCache());
        static::created(fn($model) => self::clearFooterCache());
        static::deleted(fn($model) => self::clearFooterCache());
    }

    public static function clearFooterCache()
    {
        Cache::forget('footer_settings_cache');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function settings()
    {
        $setting = self::where('id', 1)->first();

        if (!$setting) {
            $setting = self::create([
                // ... data default sama seperti sebelumnya
                // section_1_menu, dst — kirim sebagai array, $casts yang handle
            ]);
        }

        return $setting?->refresh();
    }
}
