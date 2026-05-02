<?php

namespace App\Filament\Widgets;

use App\Models\PermohonanInformasi;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DeadlineWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Permohonan Mendekati / Melewati Deadline';

    protected static ?string $pollingInterval = '60s';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PermohonanInformasi::query()
                    ->whereIn('status', ['masuk', 'diproses'])
                    ->whereNotNull('deadline_at')
                    ->whereDate('deadline_at', '<=', now()->addDays(3))
                    ->orderBy('deadline_at')
            )
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('nama_pemohon')
                    ->label('Pemohon')
                    ->limit(25),

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
                    ->color(fn($record): string => $record->isTerlambat() ? 'danger' : 'warning')
                    ->icon(
                        fn($record): string => $record->isTerlambat()
                            ? 'heroicon-m-exclamation-triangle'
                            : 'heroicon-m-clock'
                    ),

                TextColumn::make('sisa_hari')
                    ->label('Sisa Hari')
                    ->getStateUsing(fn($record): string => match (true) {
                        $record->sisa_hari < 0  => abs($record->sisa_hari) . ' hari terlambat',
                        $record->sisa_hari === 0 => 'Hari ini!',
                        default                  => $record->sisa_hari . ' hari lagi',
                    })
                    ->color(fn($record): string => match (true) {
                        $record->sisa_hari < 0  => 'danger',
                        $record->sisa_hari === 0 => 'danger',
                        $record->sisa_hari <= 2  => 'warning',
                        default                  => 'success',
                    })
                    ->weight('bold'),
            ])
            ->recordActions([
                Action::make('tangani')
                    ->label('Tangani')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('danger')
                    ->url(
                        fn(PermohonanInformasi $record): string =>
                        route(
                            'filament.ppid-new-pusda-smg.resources.permohonan-informasi.permohonan-informasis.edit',
                            ['record' => $record->slug]
                        )
                    ),
            ])
            ->emptyStateHeading('Semua permohonan dalam batas waktu')
            ->emptyStateIcon('heroicon-o-check-circle')
            ->emptyStateDescription('Tidak ada permohonan yang mendekati atau melewati deadline.')
            ->striped();
    }
}
