@php
    // Ambil pengaturan hero langsung dari database - guaranteed fresh!
    // Query langsung DB untuk bypass semua cache
    $heroSetting = DB::table('hero_settings')->where('id', 1)->first();

    // Fallback ke model jika tabel query gagal
    if (!$heroSetting) {
        $heroSetting = \App\Models\HeroSetting::settings(true);
    } else {
        // Convert stdClass ke object untuk akses property
        $heroSetting = (object) $heroSetting;
    }
@endphp

<section class="hero"
    style="background-image: url('{{ asset('images/hero-bg.jpeg') }}'); background-size: cover; background-position: center top; background-repeat: no-repeat;">
    <div class="hero-bg">
        <div class="hero-grid"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-3"></div>
    </div>

    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">
                {{ $heroSetting->title }}<br>
                <span class="hero-title-accent">{{ $heroSetting->title_accent }}</span>
            </h1>

            <p class="hero-desc">
                {{ $heroSetting->description }}
            </p>

            <div class="hero-actions">
                <a href="{{ route('permohonan.form') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane"></i>
                    {{ $heroSetting->button_1_text }}
                </a>
                <a href="{{ $heroSetting->button_2_url }}" class="btn btn-outline-white btn-lg">
                    <i class="fas fa-compass"></i>
                    {{ $heroSetting->button_2_text }}
                </a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat" data-stat-value="{{ $heroSetting->stat_1_value }}" data-stat-prefix=""
                    data-stat-decimals="false">
                    <strong>{{ $heroSetting->stat_1_value }}</strong>
                    <span>{{ $heroSetting->stat_1_label }}</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat" data-stat-value="{{ $heroSetting->stat_2_value }}" data-stat-prefix=""
                    data-stat-decimals="false">
                    <strong>{{ $heroSetting->stat_2_value }}</strong>
                    <span>{{ $heroSetting->stat_2_label }}</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat" data-stat-value="{{ $heroSetting->stat_3_value }}" data-stat-prefix="%"
                    data-stat-decimals="true">
                    <strong>{{ $heroSetting->stat_3_value }}</strong>
                    <span>{{ $heroSetting->stat_3_label }}</span>
                </div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="mascot-stage">
                <div class="orbit-ring orbit-ring-1"></div>
                <div class="orbit-ring orbit-ring-2"></div>
                <div class="orbit-ring orbit-ring-3"></div>

                <div class="orbit-dot orbit-dot-a"></div>
                <div class="orbit-dot orbit-dot-b"></div>
                <div class="orbit-dot orbit-dot-c"></div>
                <div class="orbit-dot orbit-dot-d"></div>

                <div class="logo-center">
                    <div class="logo-glow-ring"></div>
                    <div class="logo-wrap">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Pemerintah Kota Semarang"
                            class="logo-img" />
                    </div>
                    <div class="logo-label">
                        <span>Kota Semarang</span>
                    </div>
                </div>

                <div class="mascot mascot-dinar">
                    <div class="mascot-bubble mascot-bubble-left">
                        <i class="fas fa-archive"></i>
                        <span>Arsip Digital</span>
                    </div>
                    <img src="{{ asset('images/dintak/Dinar.png') }}" alt="Maskot Dinar" class="mascot-img" />
                    <div class="mascot-name">Dinar</div>
                </div>

                <div class="mascot mascot-taka">
                    <div class="mascot-bubble mascot-bubble-right">
                        <i class="fas fa-book-open"></i>
                        <span>Perpustakaan</span>
                    </div>
                    <img src="{{ asset('images/dintak/Taka.png') }}" alt="Maskot Taka" class="mascot-img" />
                    <div class="mascot-name">Taka</div>
                </div>

                <div class="sparkle sparkle-1"></div>
                <div class="sparkle sparkle-2"></div>
                <div class="sparkle sparkle-3"></div>
                <div class="sparkle sparkle-4"></div>
                <div class="sparkle sparkle-5"></div>
            </div>
        </div>

    </div>{{-- ← TUTUP .container DI SINI, sebelum wave --}}

    {{-- Wave di luar container, tetap di dalam section --}}
    <div class="hero-wave">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="var(--bg-body)" />
        </svg>
    </div>

</section>
