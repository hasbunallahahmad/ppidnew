<?php

namespace App\Filament\Widgets;

use App\Models\PermohonanInformasi;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PermohonanMasukTableWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    // Tampilkan 8 baris, tanpa pagination agar ringkas di dashboard
    protected static ?string $heading = 'Permohonan Informasi Masuk';

    protected static ?string $pollingInterval = '60s';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PermohonanInformasi::query()
                    ->whereIn('status', ['masuk', 'diproses'])
                    ->latest()
                    ->limit(8)
            )
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor tiket disalin')
                    ->fontFamily('mono')
                    ->weight('bold'),

                TextColumn::make('nama_pemohon')
                    ->label('Nama Pemohon')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('informasi_diminta')
                    ->label('Informasi Diminta')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->informasi_diminta),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'masuk'    => 'warning',
                        'diproses' => 'info',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'masuk'    => 'Masuk',
                        'diproses' => 'Diproses',
                        default    => $state,
                    }),

                TextColumn::make('deadline_at')
                    ->label('Deadline')
                    ->date('d M Y')
                    ->color(fn($record): string => match (true) {
                        $record->isTerlambat()                          => 'danger',
                        $record->deadline_at?->diffInDays(now()) <= 3  => 'warning',
                        default                                         => 'success',
                    })
                    ->icon(fn($record): string => match (true) {
                        $record->isTerlambat()                          => 'heroicon-m-exclamation-triangle',
                        $record->deadline_at?->diffInDays(now()) <= 3  => 'heroicon-m-clock',
                        default                                         => 'heroicon-m-check-circle',
                    }),

                TextColumn::make('created_at')
                    ->label('Diterima')
                    ->since()
                    ->tooltip(fn($record) => $record->created_at->locale('id')->translatedFormat('d F Y, H:i')),
            ])
            ->recordActions([
                Action::make('lihat')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->color('info')
                    ->url(
                        fn(PermohonanInformasi $record): string =>
                        route(
                            'filament.ppid-new-pusda-smg.resources.permohonan-informasi.permohonan-informasis.view',
                            ['record' => $record->slug]
                        )
                    ),

                Action::make('proses')
                    ->label('Proses')
                    ->icon('heroicon-m-arrow-path')
                    ->color('warning')
                    ->visible(
                        fn(PermohonanInformasi $record): bool =>
                        $record->status === 'masuk' && Auth::user()?->isAdmin()
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Ubah Status ke Diproses?')
                    ->modalDescription('Permohonan ini akan ditandai sedang diproses.')
                    ->action(function (PermohonanInformasi $record): void {
                        $record->update(['status' => 'diproses']);
                    })
                    ->successNotificationTitle('Status diperbarui'),
            ])
            ->emptyStateHeading('Tidak ada permohonan masuk')
            ->emptyStateDescription('Semua permohonan sudah ditangani.')
            ->emptyStateIcon('heroicon-o-inbox')
            ->striped();
    }
}
