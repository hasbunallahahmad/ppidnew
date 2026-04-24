<?php

namespace App\Providers;

use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Infografis;
use App\Models\Layanan;
use App\Models\PermohonanInformasi;
use App\Models\SiteSetting;
use App\Models\StatistikKunjungan;
use App\Observers\BeritaObserver;
use App\Observers\DokumenObserver;
use App\Observers\InfografisObserver;
use App\Observers\LayananObserver;
use App\Observers\PermohonanInformasiObserver;
use App\Observers\SiteSettingObserver;
use App\Observers\StatistikKunjunganObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Berita::observe(BeritaObserver::class);
        Dokumen::observe(DokumenObserver::class);
        Infografis::observe(InfografisObserver::class);
        Layanan::observe(LayananObserver::class);
        StatistikKunjungan::observe(StatistikKunjunganObserver::class);
        SiteSetting::observe(SiteSettingObserver::class);
        PermohonanInformasi::observe(PermohonanInformasiObserver::class);

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
