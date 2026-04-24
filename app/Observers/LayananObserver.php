<?php

namespace App\Observers;

use App\Models\Layanan;
use Illuminate\Support\Facades\Cache;

class LayananObserver
{
    public function saved(Layanan $layanan): void
    {
        $this->clearCache();
    }

    public function deleted(Layanan $layanan): void
    {
        $this->clearCache();
    }

    // ---------------------------------------------------------

    private function clearCache(): void
    {
        Cache::forget('homepage_data');
        Cache::forget('homepage_layanans');
    }
}
