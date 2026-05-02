<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AktivitasTerbaruWidget;
use App\Filament\Widgets\DeadlineWidget;
use App\Filament\Widgets\PermohonanMasukTableWidget;
use App\Filament\Widgets\PermohonanStatsWidget;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard PPID';
    protected static ?int $navigationSort = 0;


    public function getHeading(): string
    {
        $name = Auth::user()->name ?? 'Admin';
        return "Selamat datang, {$name}👋";
    }

    public function getSubheading(): ?string
    {
        return now()->locale('id')->translatedFormat('l, j F Y');
    }

    public function getWidgets(): array
    {
        return [
            PermohonanStatsWidget::class,    // baris 1: 4 stat cards
            PermohonanMasukTableWidget::class, // baris 2: tabel permohonan masuk
            DeadlineWidget::class,            // baris 3: permohonan mendekati deadline
            AktivitasTerbaruWidget::class,    // baris 4: log aktivitas
        ];
    }

    public function getColumns(): int | array
    {
        return 1; // semua widget full-width secara default
    }
}
