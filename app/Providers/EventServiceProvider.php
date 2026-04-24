<?php

namespace App\Providers;

use App\Events\BeritaPublished;
use App\Events\DokumenUploaded;
use App\Events\PermohonanMasuk;
use App\Listeners\NotifyAdminBeritaPublished;
use App\Listeners\NotifyAdminDokumenUploaded;
use App\Listeners\SendKonfirmasiPermohonan;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Mapping Event → Listener(s).
     *
     * Satu event bisa punya banyak listener.
     * Listener yang implement ShouldQueue akan otomatis dijalankan via queue.
     */
    protected $listen = [

        // ── Berita dipublikasikan ─────────────────────────────────
        BeritaPublished::class => [
            NotifyAdminBeritaPublished::class,
            // Tambahkan listener lain di sini jika dibutuhkan:
            // SendBeritaToRssFeed::class,
            // PingSearchEngineIndex::class,
        ],

        // ── Dokumen baru diaktifkan ───────────────────────────────
        DokumenUploaded::class => [
            NotifyAdminDokumenUploaded::class,
        ],

        // ── Permohonan informasi publik masuk ─────────────────────
        PermohonanMasuk::class => [
            SendKonfirmasiPermohonan::class,  // implements ShouldQueue → via queue
        ],

    ];

    /**
     * Aktifkan auto-discovery sebagai fallback.
     * Laravel akan scan folder app/Listeners untuk class yang punya
     * type-hint event di method handle() — berguna untuk listener
     * yang tidak terdaftar di $listen di atas.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false; // matikan agar mapping eksplisit di $listen selalu dipakai
    }

    public function boot(): void
    {
        //
    }
}
