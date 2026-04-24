<?php

namespace App\Filament\Resources\FooterSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FooterSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slug')
                    ->label('Slug (Keamanan)')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('brand_name')
                    ->label('Nama Brand')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('contact_email')
                    ->label('Email Kontak')
                    ->copyable()
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('contact_phone')
                    ->label('Telepon')
                    ->limit(30),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable(),
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
