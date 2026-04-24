<?php

namespace App\Observers;

use App\Models\Arsip;
use Illuminate\Support\Facades\Cache;

class ArsipObserver
{
    public function saved(Arsip $arsip): void
    {
        $this->clearCache();
    }

    public function deleted(Arsip $arsip): void
    {
        $this->clearCache();
    }

    public function restored(Arsip $arsip): void
    {
        $this->clearCache();
    }

    public function forceDeleted(Arsip $arsip): void
    {
        $this->clearCache();
    }

    // ---------------------------------------------------------

    private function clearCache(): void
    {
        // Cache key ini harus sama persis dengan yang ada di StatistikService
        Cache::forget('statistik_kearsipan');
    }
}
