<section class="stats-section">
    <div class="container">
        <div class="stats-grid">

            @php
                $stats = [
                    [
                        'icon' => 'fas fa-file-alt',
                        'value' => '12,480',
                        'label' => 'Informasi Tersedia',
                        'color' => 'blue',
                        'suffix' => '',
                    ],
                    [
                        'icon' => 'fas fa-users',
                        'value' => '3,256',
                        'label' => 'Permohonan Masuk',
                        'color' => 'green',
                        'suffix' => '',
                    ],
                    [
                        'icon' => 'fas fa-check-circle',
                        'value' => '3,198',
                        'label' => 'Permohonan Selesai',
                        'color' => 'teal',
                        'suffix' => '',
                    ],
                    [
                        'icon' => 'fas fa-building',
                        'value' => '48',
                        'label' => 'OPD Terdaftar',
                        'color' => 'orange',
                        'suffix' => '',
                    ],
                    [
                        'icon' => 'fas fa-star',
                        'value' => '98.2',
                        'label' => 'Tingkat Kepuasan',
                        'color' => 'yellow',
                        'suffix' => '%',
                    ],
                    [
                        'icon' => 'fas fa-clock',
                        'value' => '3.2',
                        'label' => 'Rata-rata Hari Respon',
                        'color' => 'purple',
                        'suffix' => ' hari',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="stat-card stat-{{ $stat['color'] }}">
                    <div class="stat-icon">
                        <i class="{{ $stat['icon'] }}"></i>
                    </div>
                    <div class="stat-body">
                        <div class="stat-value" data-target="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">
                            {{ $stat['value'] }}{{ $stat['suffix'] }}
                        </div>
                        <div class="stat-label">{{ $stat['label'] }}</div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
