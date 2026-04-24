<?php

namespace App\Filament\Resources\HeroSettings\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HeroSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Keamanan & Pengaturan')
                    ->icon('heroicon-o-shield-check')
                    ->columns(1)
                    ->schema([
                        TextInput::make('slug')
                            ->label('Slug (untuk Keamanan)')
                            ->required()
                            ->unique('hero_settings', 'slug', ignoreRecord: true)
                            ->helperText('Auto-generated dari judul untuk keamanan sistem. Jangan ubah kecuali diperlukan.')
                            ->rules('regex:/^[a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?$/')
                            ->disabled(fn($record) => $record?->id === 1),
                    ]),

                Section::make('Konten Utama')
                    ->icon('heroicon-o-pencil')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Utama')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('title_accent')
                            ->label('Judul Highlight')
                            ->helperText('Bagian yang akan di-highlight dalam warna berbeda')
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Statistik')
                    ->icon('heroicon-o-chart-bar')
                    ->columns(2)
                    ->schema([
                        TextInput::make('stat_1_value')
                            ->label('Statistik 1 - Nilai')
                            ->placeholder('Contoh: 8.240'),

                        TextInput::make('stat_1_label')
                            ->label('Statistik 1 - Label')
                            ->placeholder('Contoh: Arsip Digital'),

                        TextInput::make('stat_2_value')
                            ->label('Statistik 2 - Nilai')
                            ->placeholder('Contoh: 42.680'),

                        TextInput::make('stat_2_label')
                            ->label('Statistik 2 - Label')
                            ->placeholder('Contoh: Koleksi Buku'),

                        TextInput::make('stat_3_value')
                            ->label('Statistik 3 - Nilai')
                            ->placeholder('Contoh: 97,8%'),

                        TextInput::make('stat_3_label')
                            ->label('Statistik 3 - Label')
                            ->placeholder('Contoh: Tingkat Kepuasan'),
                    ]),

                Section::make('Tombol (Button)')
                    ->icon('heroicon-o-hand-raised')
                    ->columns(2)
                    ->schema([
                        TextInput::make('button_1_text')
                            ->label('Tombol 1 - Teks')
                            ->required()
                            ->placeholder('Contoh: Ajukan Permohonan'),

                        TextInput::make('button_1_url')
                            ->label('Tombol 1 - URL')
                            ->required()
                            ->placeholder('Contoh: # atau /permohonan'),

                        TextInput::make('button_2_text')
                            ->label('Tombol 2 - Teks')
                            ->required()
                            ->placeholder('Contoh: Jelajahi Layanan'),

                        TextInput::make('button_2_url')
                            ->label('Tombol 2 - URL')
                            ->required()
                            ->placeholder('Contoh: #layanan'),

                        TextInput::make('button_2_anchor')
                            ->label('Tombol 2 - Anchor Target')
                            ->helperText('ID element yang dituju saat tombol diklik')
                            ->placeholder('Contoh: layanan')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
