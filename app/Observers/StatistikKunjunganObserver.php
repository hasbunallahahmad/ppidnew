<?php

namespace App\Observers;

use App\Models\StatistikKunjungan;
use Illuminate\Support\Facades\Cache;

class StatistikKunjunganObserver
{
    public function saved(StatistikKunjungan $statistik): void
    {
        $this->clearCache($statistik);
    }

    public function deleted(StatistikKunjungan $statistik): void
    {
        $this->clearCache($statistik);
    }

    // ---------------------------------------------------------

    private function clearCache(StatistikKunjungan $statistik): void
    {
        Cache::forget('homepage_data');
        Cache::forget('homepage_statistik_kunjungan');

        // Bust cache spesifik periode yang berubah
        Cache::forget("statistik_kunjungan_{$statistik->periode}");
    }
}
