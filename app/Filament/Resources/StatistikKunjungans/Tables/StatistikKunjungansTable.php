<?php

namespace App\Filament\Resources\StatistikKunjungans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class StatistikKunjungansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Statistik')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah')
                    ->label('Jumlah Kunjungan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('periode')
                    ->label('Tipe Periode')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'harian' => 'success',
                        'mingguan' => 'info',
                        'bulanan' => 'warning',
                        'tahunan' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'harian' => 'Harian',
                        'mingguan' => 'Mingguan',
                        'bulanan' => 'Bulanan',
                        'tahunan' => 'Tahunan',
                        default => $state,
                    }),
                TextColumn::make('keterangan_periode')
                    ->label('Keterangan Periode')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('periode')
                    ->label('Filter Periode')
                    ->options([
                        'harian' => 'Harian',
                        'mingguan' => 'Mingguan',
                        'bulanan' => 'Bulanan',
                        'tahunan' => 'Tahunan',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
