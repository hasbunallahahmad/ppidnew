<?php

namespace App\Filament\Widgets;

use App\Models\PermohonanInformasi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PermohonanStatsWidget extends BaseWidget
{
    // Refresh otomatis setiap 60 detik
    protected ?string $pollingInterval = '60s';

    // Urutan tampil di dashboard
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $masuk    = PermohonanInformasi::masuk()->count();
        $diproses = PermohonanInformasi::diproses()->count();
        $selesai  = PermohonanInformasi::selesai()->count();
        $terlambat = PermohonanInformasi::terlambat()->count();
        $bulanIni = PermohonanInformasi::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Hitung persentase penyelesaian dari semua yang pernah masuk
        $total       = PermohonanInformasi::count();
        $pctSelesai  = $total > 0 ? round(($selesai / $total) * 100) : 0;

        return [
            Stat::make('Permohonan Masuk', $masuk)
                ->description('Menunggu diproses')
                ->descriptionIcon('heroicon-m-inbox')
                ->color($masuk > 0 ? 'warning' : 'success'),

            Stat::make('Sedang Diproses', $diproses)
                ->description('Dalam penanganan')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info'),

            Stat::make('Terlambat / Mendekati Deadline', $terlambat)
                ->description('Perlu segera ditangani')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($terlambat > 0 ? 'danger' : 'success'),

            Stat::make('Selesai Bulan Ini', $bulanIni . ' permohonan')
                ->description("Tingkat penyelesaian: {$pctSelesai}% dari total")
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
