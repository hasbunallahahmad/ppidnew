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
use App\Policies\PermohonanInformasiPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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

        RateLimiter::for('permohonan', function (Request $request) {
            return Limit::perHour(5)
                ->by($request->ip())
                ->response(function () {
                    return back()->withErrors([
                        'error' => 'Anda telah mencapai batas maksimum permohonan informasi. Silakan coba lagi nanti.'
                    ])->withInput();
                });
        });

        RateLimiter::for('tracking', function (Request $request) {
            return Limit::perMinute(10)
                ->by($request->ip())
                ->response(function () {
                    return back()->withErrors([
                        'error' => 'Terlalu banyak percobaan. Silakan coba lagi sebentar.',
                    ]);
                });
        });
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
        Gate::policy(PermohonanInformasi::class, PermohonanInformasiPolicy::class);

        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }
}
