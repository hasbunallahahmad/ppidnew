<?php

namespace App\Filament\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Spatie\Activitylog\Models\Activity;

class AktivitasTerbaruWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Aktivitas Terbaru';

    protected static ?string $pollingInterval = '60s';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Activity::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('causer.name')
                    ->label('Oleh')
                    ->default('Sistem')
                    ->icon('heroicon-m-user-circle')
                    ->weight('bold'),

                TextColumn::make('log_name')
                    ->label('Modul')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'permohonan' => 'warning',
                        'berita'     => 'info',
                        'dokumen'    => 'success',
                        default      => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'permohonan' => 'Permohonan',
                        'berita'     => 'Berita',
                        'dokumen'    => 'Dokumen',
                        default      => ucfirst($state),
                    }),

                TextColumn::make('description')
                    ->label('Aksi')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'created' => 'Dibuat',
                        'updated' => 'Diperbarui',
                        'deleted' => 'Dihapus',
                        default   => ucfirst($state),
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'info',
                        'deleted' => 'danger',
                        default   => 'gray',
                    }),

                TextColumn::make('properties')
                    ->label('Perubahan')
                    ->getStateUsing(function (Activity $record): string {
                        $dirty = $record->properties['attributes'] ?? [];
                        if (empty($dirty)) {
                            return '-';
                        }
                        // Tampilkan field yang berubah saja
                        $fields = array_keys($dirty);
                        return implode(', ', array_map('ucfirst', $fields));
                    })
                    ->limit(40)
                    ->color('gray'),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since()
                    ->tooltip(fn($record) => $record->created_at->locale('id')->translatedFormat('d F Y, H:i')),
            ])
            ->emptyStateHeading('Belum ada aktivitas')
            ->emptyStateIcon('heroicon-o-clock')
            ->emptyStateDescription('Log aktivitas akan muncul setelah ada perubahan data.')
            ->striped();
    }
}
