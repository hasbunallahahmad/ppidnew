<?php

namespace App\Filament\Resources\PermohonanInformasi\Tables;

use App\Models\PermohonanInformasi;
use Devletes\FilamentProgressBar\Tables\Columns\ProgressBarColumn;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PermohonanInformasisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->description(
                        fn(PermohonanInformasi $record) =>
                        $record->created_at?->format('d M Y H:i')
                    ),

                TextColumn::make('nama_pemohon')
                    ->label('Nama Pemohon')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->toggleable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->limit(30)
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('no_telepon')
                    ->label('No. Telepon')
                    ->searchable()
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('informasi_diminta')
                    ->label('Informasi Diminta')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(
                        fn(PermohonanInformasi $record) =>
                        e($record->informasi_diminta)
                    ),

                // INLINE STATUS UPDATE - Klik langsung di tabel untuk ubah status
                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'masuk' => 'Masuk',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                        'banding' => 'Banding',
                    ])
                    // ->colors([
                    //     'masuk' => 'info',
                    //     'diproses' => 'warning',
                    //     'selesai' => 'success',
                    //     'ditolak' => 'danger',
                    //     'banding' => 'gray',
                    // ])
                    ->sortable()
                    ->grow(false)
                    ->searchable()
                    ->rules(['required'])
                    ->afterStateUpdated(function (PermohonanInformasi $record, $state) {
                        // Auto-set selesai_at saat status berubah ke selesai/ditolak
                        if (in_array($state, ['selesai', 'ditolak']) && $record->selesai_at === null) {
                            $record->update(['selesai_at' => now()]);
                        }

                        // Optional: Log activity untuk tracking
                        activity()
                            ->performedOn($record)
                            ->withProperties(['old_status' => $record->getOriginal('status'), 'new_status' => $state])
                            ->log('Status diubah di tabel');
                    }),

                ProgressBarColumn::make('progress')
                    ->maxValue(100)
                    ->label('Progress')
                    ->warningThreshold(34)   // 33% masuk → warning (kuning)
                    ->dangerThreshold(68)    // 67% diproses → danger (merah)
                    ->successColor('#22c55e') // 100% → hijau
                    ->warningColor('#f59e0b') // kuning
                    ->dangerColor('#3b82f6')  // biru (atau warna lain untuk "sedang proses")
                    ->getStateUsing(function (PermohonanInformasi $record) {
                        $totalSteps = 3; // Masuk, Diproses, Selesai,
                        $currentStep = match ($record->status) {
                            'masuk' => 1,
                            'diproses' => 2,
                            'selesai' => 3,
                            'ditolak' => 3,
                            'banding' => 2,
                            default => 0,
                        };
                        return ($currentStep / $totalSteps) * 100;
                    }),

                TextColumn::make('deadline_at')
                    ->label('Deadline')
                    ->date('d M Y')
                    ->sortable()
                    ->tooltip(
                        fn(PermohonanInformasi $record) =>
                        $record->isTerlambat() ? 'TERLAMBAT' : 'Sisa hari: ' . $record->sisa_hari
                    )
                    ->color(
                        fn(PermohonanInformasi $record) =>
                        $record->isTerlambat() ? 'danger' : null
                    ),

                TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'masuk' => 'Masuk',
                        'diproses' => 'Sedang Diproses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                        'banding' => 'Banding',
                    ])
                    ->multiple(),

                Filter::make('terlambat')
                    ->label('Terlambat')
                    ->query(fn(Builder $query): Builder => $query->terlambat()),

                Filter::make('mendekati_deadline')
                    ->label('Mendekati Deadline')
                    ->query(fn(Builder $query): Builder => $query->mendekatiDeadline(3)),

                Filter::make('today')
                    ->label('Hari Ini')
                    ->query(fn(Builder $query): Builder => $query->whereDate('created_at', today()))
                    ->indicateUsing(fn(array $data): ?string => $data['isActive'] ? 'Hari Ini' : null),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label(''),
                EditAction::make()
                    ->label(''),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('update-status')
                        ->label('Ubah Status')
                        ->icon('heroicon-o-pencil')
                        ->requiresConfirmation()
                        ->modalHeading('Ubah Status Permohonan')
                        ->modalDescription('Apakah Anda yakin ingin mengubah status permohonan yang dipilih?')
                        ->modalSubmitActionLabel('Ubah Status')
                        ->schema([
                            Select::make('status')
                                ->label('Status Baru')
                                ->required()
                                ->options([
                                    'masuk' => 'Masuk',
                                    'diproses' => 'Sedang Diproses',
                                    'selesai' => 'Selesai',
                                    'ditolak' => 'Ditolak',
                                ]),
                            Textarea::make('catatan_admin')
                                ->label('Catatan')
                                ->rows(3)
                                ->maxLength(1000)
                                ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),
                        ])
                        ->action(function (array $data, Collection $records) {
                            $records->each(function (PermohonanInformasi $record) use ($data) {
                                $record->update([
                                    'status' => $data['status'],
                                    'catatan_admin' => $data['catatan_admin'] ?? $record->catatan_admin,
                                ]);
                            });
                        }),
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('export-csv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () {
                        $records = PermohonanInformasi::query()->get();
                        $csv = "No Tiket,Nama,Email,Telepon,Status,Tanggal Masuk,Deadline\n";

                        foreach ($records as $record) {
                            $csv .= implode(',', [
                                '"' . e($record->nomor_tiket) . '"',
                                '"' . e($record->nama_pemohon) . '"',
                                '"' . e($record->email) . '"',
                                '"' . e($record->no_telepon) . '"',
                                '"' . e($record->status) . '"',
                                '"' . $record->created_at->format('Y-m-d H:i:s') . '"',
                                '"' . $record->deadline_at?->format('Y-m-d') . '"',
                            ]) . "\n";
                        }

                        return response()->streamDownload(function () use ($csv) {
                            echo $csv;
                        }, 'permohonan-' . now()->format('Y-m-d') . '.csv');
                    }),
            ]);
    }
}
