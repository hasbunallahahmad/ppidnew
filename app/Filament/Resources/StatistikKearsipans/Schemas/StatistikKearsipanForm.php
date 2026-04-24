<?php

namespace App\Filament\Resources\StatistikKearsipans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class StatistikKearsipanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components(static::getComponents());
    }
    public static function getComponents(): array
    {
        return [
            Section::make('Informasi Utama')
                ->icon('heroicon-o-document-text')
                ->description('Judul dan info pembaruan data kearsipan')
                ->schema([
                    TextInput::make('judul')
                        ->label('Judul Rekapitulasi')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Rekapitulasi Arsip Semester II 2024')
                        ->columnSpanFull(),

                    TextInput::make('diperbarui')
                        ->label('Terakhir Diperbarui')
                        ->maxLength(100)
                        ->placeholder('Contoh: Maret 2025')
                        ->suffixIcon(Heroicon::Clock),
                ])->columns(2),

            Section::make('Data Statistik Arsip')
                ->icon('heroicon-o-archive-box')
                ->description('Jumlah masing-masing jenis arsip dalam satuan berkas/file')
                ->schema([
                    TextInput::make('arsip_aktif')
                        ->label('Arsip Aktif')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->suffix('berkas')
                        ->placeholder('0'),

                    TextInput::make('arsip_inaktif')
                        ->label('Arsip Inaktif')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->suffix('berkas')
                        ->placeholder('0'),

                    TextInput::make('arsip_statis')
                        ->label('Arsip Statis')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->suffix('berkas')
                        ->placeholder('0'),

                    TextInput::make('arsip_vital')
                        ->label('Arsip Vital')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->suffix('berkas')
                        ->placeholder('0'),

                    TextInput::make('arsip_digital')
                        ->label('Arsip Digital')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->suffix('file')
                        ->placeholder('0'),
                ])->columns(2),
        ];
    }
}
