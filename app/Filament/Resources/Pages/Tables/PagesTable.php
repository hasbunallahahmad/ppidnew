<?php

namespace App\Filament\Resources\Pages\Tables;

use App\Filament\Pages\EditInformasiSertaMerta;
use App\Filament\Pages\EditInformasiSetiapSaat;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable(),
                IconColumn::make('pdf_file')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit')
                    ->url(function ($record): string {
                        // Slug yang diarahkan ke custom page
                        $customPages = [
                            'informasi-setiap-saat' => EditInformasiSetiapSaat::getUrl(),
                            'informasi-serta-merta' => EditInformasiSertaMerta::getUrl(),
                            // Tambahkan slug lain di sini jika nanti ada custom page baru:
                            // 'informasi-serta-merta' => EditInformasiSertaMerta::getUrl(),
                        ];

                        return $customPages[$record->slug]
                            ?? \App\Filament\Resources\Pages\PageResource::getUrl('edit', ['record' => $record->slug]);
                    }),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
