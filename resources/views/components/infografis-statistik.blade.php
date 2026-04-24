{{-- resources/views/components/infografis-statistik.blade.php --}}
@props(['statistikKearsipan' => [], 'statistikKunjungan' => []])

<section class="infografis-section">
    <div class="container">
        <div class="infografis-layout">

            {{-- Statistik Kearsipan --}}
            <div class="infografis-col">
                <div class="section-header left-aligned">
                    <div class="section-tag">Data</div>
                    <h2 class="section-title">Statistik <span>Kearsipan</span></h2>
                </div>

                <div class="statistik-card reveal">
                    <div class="statistik-header">
                        <h3>{{ $statistikKearsipan['judul'] ?? '-' }}</h3>
                        @if (!empty($statistikKearsipan['diperbarui']))
                            <span class="stat-update">
                                <i class="fas fa-sync-alt"></i>
                                Diperbarui: {{ $statistikKearsipan['diperbarui'] }}
                            </span>
                        @endif
                    </div>

                    <div class="statistik-bars">
                        @forelse ($statistikKearsipan['items'] ?? [] as $k)
                            <div class="stat-bar-item">
                                <div class="stat-bar-label">
                                    <span>{{ $k['nama'] }}</span>
                                    <span>
                                        {{ number_format($k['jumlah'], 0, ',', '.') }}
                                        {{ $k['satuan'] ?? 'berkas' }}
                                    </span>
                                </div>
                                <div class="stat-bar-track">
                                    <div class="stat-bar-fill" style="width: {{ $k['pct'] }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Data belum tersedia.</p>
                        @endforelse
                    </div>

                    @if (!empty($statistikKearsipan['ringkasan']))
                        <div class="statistik-total">
                            @foreach ($statistikKearsipan['ringkasan'] as $s)
                                <div class="st-item">
                                    <strong>{{ $s['nilai'] }}</strong>
                                    <span>{{ $s['label'] }}</span>
                                </div>
                                @if (!$loop->last)
                                    <div class="st-divider"></div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Statistik Kunjungan --}}
            <div class="statistik-col">
                <div class="section-header left-aligned">
                    <div class="section-tag">Data</div>
                    <h2 class="section-title">Statistik <span>Kunjungan</span></h2>
                </div>

                <div class="statistik-card reveal">
                    <div class="statistik-header">
                        <h3>Kunjungan Perpustakaan</h3>
                        @if (!empty($statistikKunjungan['diperbarui']))
                            <span class="stat-update">
                                <i class="fas fa-sync-alt"></i>
                                Diperbarui: {{ $statistikKunjungan['diperbarui'] }}
                            </span>
                        @endif
                    </div>

                    <div class="statistik-bars">
                        @forelse ($statistikKunjungan['items'] ?? [] as $k)
                            <div class="stat-bar-item">
                                <div class="stat-bar-label">
                                    <span>{{ $k['nama'] }}</span>
                                    <span>{{ number_format($k['jumlah'], 0, ',', '.') }} pengunjung</span>
                                </div>
                                <div class="stat-bar-track">
                                    <div class="stat-bar-fill" style="width: {{ $k['pct'] }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Data belum tersedia.</p>
                        @endforelse
                    </div>

                    @if (!empty($statistikKunjungan['total']))
                        <div class="statistik-total">
                            <div class="st-item">
                                <strong>{{ $statistikKunjungan['total'] }}</strong>
                                <span>Total Kunjungan</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
