<?php

namespace App\Filament\Resources\StatistikKunjungans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StatistikKunjunganForm
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
            Section::make('Data Statistik')
                ->icon('heroicon-o-chart-bar')
                ->description('Informasi utama statistik kunjungan')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Statistik')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Kunjungan Perpustakaan, Peminjaman Buku')
                        ->helperText('Nama atau label jenis statistik kunjungan')
                        ->autocomplete('off')
                        ->afterStateHydrated(function (TextInput $component, $state) {
                            if ($state) {
                                $component->state(strip_tags(trim($state)));
                            }
                        })
                        ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),

                    TextInput::make('jumlah')
                        ->label('Jumlah Kunjungan')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->suffix('orang')
                        ->placeholder('0')
                        ->helperText('Total jumlah kunjungan pada periode ini'),
                ])->columns(2),

            Section::make('Informasi Periode')
                ->icon('heroicon-o-calendar-days')
                ->description('Detail periode waktu statistik')
                ->columnSpanFull()
                ->schema([
                    Select::make('periode')
                        ->label('Tipe Periode')
                        ->required()
                        ->options([
                            'harian'    => 'Harian',
                            'mingguan'  => 'Mingguan',
                            'bulanan'   => 'Bulanan',
                            'tahunan'   => 'Tahunan',
                        ])
                        ->placeholder('Pilih tipe periode')
                        ->native(false),

                    TextInput::make('keterangan_periode')
                        ->label('Keterangan Periode')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Januari 2025, Minggu ke-3 Maret 2025')
                        ->helperText('Deskripsi spesifik periode, misal nama bulan atau rentang tanggal')
                        ->autocomplete('off')
                        ->afterStateHydrated(function (TextInput $component, $state) {
                            if ($state) {
                                $component->state(strip_tags(trim($state)));
                            }
                        })
                        ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),
                ])->columns(2),
        ];
    }
}
