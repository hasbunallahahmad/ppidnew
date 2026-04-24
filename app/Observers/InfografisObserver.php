<?php

namespace App\Observers;

use App\Models\Infografis;
use Illuminate\Support\Facades\Cache;

class InfografisObserver
{
    public function saved(Infografis $infografis): void
    {
        $this->clearCache();
    }

    public function deleted(Infografis $infografis): void
    {
        $this->clearCache();
    }

    public function restored(Infografis $infografis): void
    {
        $this->clearCache();
    }

    public function forceDeleted(Infografis $infografis): void
    {
        $this->clearCache();
    }

    // ---------------------------------------------------------

    private function clearCache(): void
    {
        Cache::forget('homepage_data');
        Cache::forget('homepage_infografis');
    }
}
