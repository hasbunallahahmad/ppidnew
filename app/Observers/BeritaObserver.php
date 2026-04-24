<?php

namespace App\Observers;

use App\Events\BeritaPublished;
use App\Models\Berita;
use Illuminate\Support\Facades\Cache;

class BeritaObserver
{
    /**
     * Dipanggil setelah INSERT atau UPDATE berhasil.
     * Selalu bust cache homepage agar perubahan langsung tampil.
     */
    public function saved(Berita $berita): void
    {
        $this->clearCache();

        // Dispatch event khusus hanya jika status BARU BERUBAH ke 'published'
        // wasChanged() aman dipakai di saved() — sudah tersimpan ke DB
        if ($berita->wasChanged('status') && $berita->status === 'published') {
            event(new BeritaPublished($berita));
        }
    }

    /**
     * Dipanggil saat soft-delete (delete() tanpa forceDelete).
     */
    public function deleted(Berita $berita): void
    {
        $this->clearCache();
    }

    /**
     * Dipanggil saat restore() dari soft-delete.
     */
    public function restored(Berita $berita): void
    {
        $this->clearCache();
    }

    /**
     * Dipanggil saat forceDelete() — hapus permanen.
     */
    public function forceDeleted(Berita $berita): void
    {
        $this->clearCache();
    }

    // ---------------------------------------------------------

    private function clearCache(): void
    {
        Cache::forget('homepage_data');
        Cache::forget('homepage_berita_featured');
        Cache::forget('homepage_berita_list');
    }
}
