<?php

namespace App\Observers;

use App\Events\DokumenUploaded;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Cache;

class DokumenObserver
{
    public function saved(Dokumen $dokumen): void
    {
        $this->clearCache($dokumen);

        // Dispatch event saat dokumen baru pertama kali diaktifkan
        if ($dokumen->wasChanged('is_active') && $dokumen->is_active) {
            event(new DokumenUploaded($dokumen));
        }

        // Atau saat dokumen baru dibuat dalam kondisi aktif
        if ($dokumen->wasRecentlyCreated && $dokumen->is_active) {
            event(new DokumenUploaded($dokumen));
        }
    }

    public function deleted(Dokumen $dokumen): void
    {
        $this->clearCache($dokumen);
    }

    public function restored(Dokumen $dokumen): void
    {
        $this->clearCache($dokumen);
    }

    public function forceDeleted(Dokumen $dokumen): void
    {
        $this->clearCache($dokumen);
    }

    // ---------------------------------------------------------

    private function clearCache(Dokumen $dokumen): void
    {
        Cache::forget('homepage_data');
        Cache::forget('homepage_daftar_informasi');

        // Bust cache count per tipe informasi (dipakai di 4 card homepage)
        Cache::forget("dokumen_count_{$dokumen->tipe_informasi}");
    }
}
