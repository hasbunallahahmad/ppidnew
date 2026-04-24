{{-- resources/views/components/dokumen-permohonan.blade.php --}}
<section class="dokumen-section">
    <div class="container">

        {{-- Daftar Informasi --}}
        <div class="section-header center-aligned">
            <div class="section-tag">Dokumen</div>
            <h2 class="section-title">Daftar Informasi <span>Publik</span></h2>
            <p class="section-desc">Kategori informasi yang wajib tersedia sesuai UU No. 14 Tahun 2008 tentang
                Keterbukaan Informasi Publik</p>
        </div>

        <div class="daftar-info-grid">
            @php
                $daftarInfo = [
                    [
                        'icon' => 'fas fa-calendar-check',
                        'color' => 'blue',
                        'title' => 'Informasi Berkala',
                        'desc' =>
                            'Informasi yang wajib disediakan dan diumumkan secara berkala minimal 6 bulan sekali.',
                        // 'count' => '284',
                        'badge' => 'Wajib Ada',
                        'route' => 'page.informasi-berkala',
                    ],
                    [
                        'icon' => 'fas fa-infinity',
                        'color' => 'green',
                        'title' => 'Informasi Setiap Saat',
                        'desc' => 'Informasi yang harus tersedia setiap saat dan dapat diakses kapanpun oleh pemohon.',
                        'count' => '1.092',
                        'badge' => 'Tersedia 24/7',
                        'route' => 'page.informasi-setiap-saat',
                    ],
                    [
                        'icon' => 'fas fa-bolt',
                        'color' => 'orange',
                        'title' => 'Informasi Serta Merta',
                        'desc' => 'Informasi yang mengancam hajat hidup orang banyak dan ketertiban umum.',
                        'count' => '47',
                        'badge' => 'Darurat',
                        'route' => 'page.informasi-serta-merta',
                    ],
                    [
                        'icon' => 'fas fa-lock',
                        'color' => 'gray',
                        'title' => 'Informasi Dikecualikan',
                        'desc' => 'Informasi yang dikecualikan sesuai peraturan perundang-undangan yang berlaku.',
                        'count' => '23',
                        'badge' => 'Terbatas',
                        'route' => 'page.informasi-dikecualikan',
                    ],
                ];
            @endphp

            @foreach ($daftarInfo as $item)
                <div class="daftar-card daftar-{{ $item['color'] }}">
                    <div class="daftar-icon"><i class="{{ $item['icon'] }}"></i></div>
                    <div class="daftar-body">
                        <div class="daftar-top">
                            <h3>{{ $item['title'] }}</h3>
                            <span class="daftar-badge badge-{{ $item['color'] }}">{{ $item['badge'] }}</span>
                        </div>
                        <p>{{ $item['desc'] }}</p>
                        <div class="daftar-footer">
                            {{-- <span class="daftar-count">{{ $item['count'] }} dokumen</span> --}}
                            <a href="{{ route($item['route']) }}" class="daftar-link">Lihat <i
                                    class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Permohonan CTA --}}
        <div class="permohonan-cta">
            <div class="cta-content">
                <div class="cta-icon"><i class="fas fa-paper-plane"></i></div>
                <div class="cta-text">
                    <h3>Tidak menemukan informasi yang Anda cari?</h3>
                    <p>Ajukan permohonan informasi secara online. Kami akan merespons dalam waktu <strong>10 hari
                            kerja</strong> sesuai ketentuan UU KIP.</p>
                </div>
                <div class="cta-actions">
                    <a href="{{ route('permohonan.form') }}" class="btn btn-primary" target="_blank">
                        <i class="fas fa-plus-circle"></i> Ajukan Permohonan
                    </a>
                    <a href="{{ route('permohonan.care') }}" class="btn btn-ghost" target="_blank">
                        <i class="fas fa-info-circle"></i> Cara Permohonan
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
