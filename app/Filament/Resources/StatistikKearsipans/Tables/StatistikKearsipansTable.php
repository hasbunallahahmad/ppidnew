<?php

namespace App\Filament\Resources\StatistikKearsipans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatistikKearsipansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('arsip_aktif')
                    ->label('Aktif')
                    ->numeric(thousandsSeparator: '.')
                    ->suffix(' berkas')
                    ->alignRight(),

                TextColumn::make('arsip_inaktif')
                    ->label('Inaktif')
                    ->numeric(thousandsSeparator: '.')
                    ->suffix(' berkas')
                    ->alignRight(),

                TextColumn::make('arsip_statis')
                    ->label('Statis')
                    ->numeric(thousandsSeparator: '.')
                    ->suffix(' berkas')
                    ->alignRight(),

                TextColumn::make('arsip_vital')
                    ->label('Vital')
                    ->numeric(thousandsSeparator: '.')
                    ->suffix(' berkas')
                    ->alignRight(),

                TextColumn::make('arsip_digital')
                    ->label('Digital')
                    ->numeric(thousandsSeparator: '.')
                    ->suffix(' file')
                    ->alignRight(),

                TextColumn::make('diperbarui')
                    ->label('Diperbarui')
                    ->badge()
                    ->color('info'),

                TextColumn::make('updated_at')
                    ->label('Diedit')
                    ->dateTime('d M Y, H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
