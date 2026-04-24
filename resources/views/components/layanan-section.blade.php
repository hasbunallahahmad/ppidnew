{{-- resources/views/components/layanan-section.blade.php --}}

{{--
    PERSIAPAN SCREENSHOT:
    Simpan file screenshot Anda di folder berikut:
      public/images/screenshot-selaras.png
      public/images/screenshot-opac.png
      public/images/screenshot-sibooky.png

    Cara ambil screenshot yang bagus:
    - Buka browser, set zoom ke 80-100%
    - Gunakan ekstensi "GoFullPage" atau "Awesome Screenshot"
    - Crop bagian atas ±600-800px (area yang paling representatif)
    - Simpan sebagai .png atau .jpg (disarankan .webp untuk performa lebih baik)
--}}

<section class="layanan-section" id="layanan">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Layanan Digital Kami</div>
            <h2 class="section-title">Akses Layanan <span>Dinas Arsip & Perpustakaan</span></h2>
            <p class="section-desc">Tiga platform digital resmi Dinas Arsip dan Perpustakaan Kota Semarang untuk
                memudahkan masyarakat mengakses arsip, katalog buku, dan koleksi digital</p>
        </div>

        <div class="layanan-digital-grid">

            {{-- ============================================================
                 CARD 1 — SELARAS
            ============================================================ --}}
            <div class="layanan-digital-card selaras">
                <div class="app-preview">
                    <div class="browser-bar">
                        <div class="browser-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="browser-url">
                            <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                                <path d="M9 5H3V3.5C3 2.12 4.12 1 5.5 1S8 2.12 8 3.5H9V5Z" stroke="currentColor"
                                    stroke-width="1" fill="none" />
                                <rect x="1.5" y="5" width="9" height="6" rx="1" stroke="currentColor"
                                    stroke-width="1" fill="none" />
                            </svg>
                            selaras.semarangkota.go.id
                        </div>
                    </div>
                    <div class="app-screen selaras-screen">
                        <img src="{{ asset('images/screenshot-selaras.png') }}" alt="Screenshot SELARAS" loading="lazy"
                            onerror="this.closest('.app-screen').classList.add('img-error')" class="app-screenshot">
                    </div>
                </div>

                <div class="app-info">
                    <div class="app-info-header">
                        <div class="app-icon-wrap selaras-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                <path d="M9 9h6M9 12h6M9 15h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="app-title">SELARAS</h3>
                            <p class="app-subtitle">Sistem Elektronik Layanan ARsip terintegrASi</p>
                        </div>
                    </div>
                    <p class="app-desc">
                        Database arsip digital resmi Kota Semarang. Telusuri koleksi arsip berdasarkan asal,
                        klasifikasi, jenis, dan kurun waktu secara mudah dan terstruktur.
                    </p>
                    <div class="app-tags">
                        <span class="app-tag">Arsip Digital</span>
                        <span class="app-tag">Database Publik</span>
                        <span class="app-tag">Dokumen Resmi</span>
                    </div>
                    <a href="https://selaras.semarangkota.go.id/" target="_blank" rel="noopener"
                        class="app-cta selaras-cta">
                        Akses SELARAS
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                            <polyline points="15 3 21 3 21 9" />
                            <line x1="10" y1="14" x2="21" y2="3" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ============================================================
                 CARD 2 — OPAC Perpustakaan
            ============================================================ --}}
            <div class="layanan-digital-card opac">
                <div class="app-preview">
                    <div class="browser-bar">
                        <div class="browser-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="browser-url">
                            <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                                <path d="M9 5H3V3.5C3 2.12 4.12 1 5.5 1S8 2.12 8 3.5H9V5Z" stroke="currentColor"
                                    stroke-width="1" fill="none" />
                                <rect x="1.5" y="5" width="9" height="6" rx="1" stroke="currentColor"
                                    stroke-width="1" fill="none" />
                            </svg>
                            perpustakaan.semarangkota.go.id/opac
                        </div>
                    </div>
                    <div class="app-screen opac-screen">
                        <img src="{{ asset('images/screenshot-opac.png') }}" alt="Screenshot OPAC Perpustakaan"
                            loading="lazy" onerror="this.closest('.app-screen').classList.add('img-error')"
                            class="app-screenshot">
                    </div>
                </div>

                <div class="app-info">
                    <div class="app-info-header">
                        <div class="app-icon-wrap opac-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="app-title">OPAC Perpustakaan</h3>
                            <p class="app-subtitle">Online Public Access Catalog</p>
                        </div>
                    </div>
                    <p class="app-desc">
                        Katalog buku online perpustakaan Kota Semarang. Cari koleksi berdasarkan judul, pengarang,
                        subjek, atau ISBN, dan cek ketersediaan buku secara langsung.
                    </p>
                    <div class="app-tags">
                        <span class="app-tag">Katalog Buku</span>
                        <span class="app-tag">Ketersediaan Real-time</span>
                        <span class="app-tag">Pencarian Lanjutan</span>
                    </div>
                    <a href="https://perpustakaan.semarangkota.go.id/opac/" target="_blank" rel="noopener"
                        class="app-cta opac-cta">
                        Cari Koleksi Buku
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                            <polyline points="15 3 21 3 21 9" />
                            <line x1="10" y1="14" x2="21" y2="3" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ============================================================
                 CARD 3 — SiBooky
            ============================================================ --}}
            <div class="layanan-digital-card sibooky">
                <div class="app-preview">
                    <div class="browser-bar">
                        <div class="browser-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="browser-url">
                            <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                                <path d="M9 5H3V3.5C3 2.12 4.12 1 5.5 1S8 2.12 8 3.5H9V5Z" stroke="currentColor"
                                    stroke-width="1" fill="none" />
                                <rect x="1.5" y="5" width="9" height="6" rx="1"
                                    stroke="currentColor" stroke-width="1" fill="none" />
                            </svg>
                            sibooky.semarangkota.go.id
                        </div>
                    </div>
                    <div class="app-screen sibooky-screen">
                        <img src="{{ asset('images/screenshot-sibooky.png') }}" alt="Screenshot SiBooky"
                            loading="lazy" onerror="this.closest('.app-screen').classList.add('img-error')"
                            class="app-screenshot">
                    </div>
                </div>

                <div class="app-info">
                    <div class="app-info-header">
                        <div class="app-icon-wrap sibooky-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <rect x="2" y="3" width="20" height="14" rx="2" />
                                <line x1="8" y1="21" x2="16" y2="21" />
                                <line x1="12" y1="17" x2="12" y2="21" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="app-title">SiBooky</h3>
                            <p class="app-subtitle">Perpustakaan Digital Kota Semarang</p>
                        </div>
                    </div>
                    <p class="app-desc">
                        Baca ribuan e-book, buku digital, dan konten multimedia kapan saja dan di mana saja. Nikmati
                        pengalaman membaca modern dengan koleksi yang terus bertambah.
                    </p>
                    <div class="app-tags">
                        <span class="app-tag">E-Book</span>
                        <span class="app-tag">Baca Online</span>
                        <span class="app-tag">Akses Gratis</span>
                    </div>
                    <a href="https://sibooky.semarangkota.go.id/" target="_blank" rel="noopener"
                        class="app-cta sibooky-cta">
                        Buka SiBooky
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                            <polyline points="15 3 21 3 21 9" />
                            <line x1="10" y1="14" x2="21" y2="3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     CSS TAMBAHAN — Tambahkan ke file CSS utama Anda
     (atau letakkan di dalam @push('styles') / @once jika pakai stack)
============================================================ --}}
@once
    <style>
        /* Pastikan app-screen tidak punya padding bawaan yang mengganggu */
        .app-screen {
            overflow: hidden;
            padding: 0 !important;
            position: relative;
        }

        /* Gambar screenshot memenuhi seluruh area app-screen */
        .app-screenshot {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            display: block;
            transition: transform 0.45s ease;
        }

        /* Efek zoom halus saat card di-hover */
        .layanan-digital-card:hover .app-screenshot {
            transform: scale(1.04);
        }

        /* Fallback tampilan jika file gambar tidak ditemukan */
        .app-screen.img-error::after {
            content: '🖼️  Pratinjau tidak tersedia';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #aaa;
            background: #f8f8f8;
            text-align: center;
        }
    </style>
@endonce
