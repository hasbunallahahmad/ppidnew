<?php

namespace App\Observers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettingObserver
{
    public function saved(SiteSetting $setting): void
    {
        $this->clearCache($setting);
    }

    public function deleted(SiteSetting $setting): void
    {
        $this->clearCache($setting);
    }

    // ---------------------------------------------------------

    private function clearCache(SiteSetting $setting): void
    {
        // Bust cache key spesifik yang berubah
        Cache::forget("site_setting:{$setting->key}");

        // Bust cache group-nya sekaligus
        Cache::forget("site_settings_group:{$setting->group}");

        // Bust full homepage cache karena settings bisa tampil di mana saja
        Cache::forget('homepage_data');
    }
}
