<?php

namespace App\Observers;

use App\Events\PermohonanMasuk;
use App\Models\PermohonanInformasi;
use Illuminate\Support\Facades\Cache;

class PermohonanInformasiObserver
{
    public function created(PermohonanInformasi $permohonan): void
    {
        // Dispatch event agar admin mendapat notifikasi
        event(new PermohonanMasuk($permohonan));

        // Bust cache counter di dashboard
        $this->clearCache();
    }

    public function saved(PermohonanInformasi $permohonan): void
    {
        // Bust cache dashboard saat status berubah
        if ($permohonan->wasChanged('status')) {
            $this->clearCache();
        }
    }

    public function deleted(PermohonanInformasi $permohonan): void
    {
        $this->clearCache();
    }

    // ---------------------------------------------------------

    private function clearCache(): void
    {
        Cache::forget('dashboard_permohonan_counts');
    }
}
