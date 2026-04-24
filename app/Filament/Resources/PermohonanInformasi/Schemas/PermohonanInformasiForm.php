<?php

namespace App\Filament\Resources\PermohonanInformasi\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Filament\Schemas\Components\Section;

class PermohonanInformasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Pemohon')
                    ->icon('heroicon-o-user')
                    ->description('Informasi pribadi pemohon')
                    ->schema([
                        TextInput::make('nama_pemohon')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->minLength(3)
                            ->regex('/^[a-zA-Z\s\.\-\'éèêëàâäùûüôöœçñ]+$/')
                            ->helperText('Hanya huruf, spasi, titik, dan tanda hubung')
                            ->autocomplete('off')
                            ->afterStateHydrated(function (TextInput $component, $state) {
                                if ($state) {
                                    $component->state(strip_tags(trim($state)));
                                }
                            })
                            ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            // ->lowerCase()
                            ->autocomplete('off')
                            ->afterStateHydrated(function (TextInput $component, $state) {
                                if ($state) {
                                    $component->state(strip_tags(trim(strtolower($state))));
                                }
                            })
                            ->dehydrateStateUsing(fn($state) => e(strip_tags(trim(strtolower($state))))),

                        TextInput::make('no_telepon')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required()
                            ->regex('/^(\+62|0)[0-9]{9,12}$/')
                            ->helperText('Format: 08xxxxxxxxxx atau +62xxxxxxxxxx')
                            ->autocomplete('off')
                            ->afterStateHydrated(function (TextInput $component, $state) {
                                if ($state) {
                                    $component->state(preg_replace('/\s+/', '', strip_tags($state)));
                                }
                            })
                            ->dehydrateStateUsing(fn($state) => preg_replace('/\s+/', '', e(strip_tags($state)))),

                        Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->rows(3)
                            ->minLength(10)
                            ->maxLength(500)
                            ->autocomplete('off')
                            ->afterStateHydrated(function (Textarea $component, $state) {
                                if ($state) {
                                    $component->state(strip_tags(trim($state)));
                                }
                            })
                            ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),

                        Select::make('jenis_identitas')
                            ->label('Jenis Identitas')
                            ->required()
                            ->options([
                                'KTP' => 'KTP',
                                'SIM' => 'SIM',
                                'Paspor' => 'Paspor',
                                'KITAS' => 'KITAS',
                                'Surat Keterangan Lainnya' => 'Surat Keterangan Lainnya',
                            ])
                            ->placeholder('Pilih jenis identitas'),

                        TextInput::make('no_identitas')
                            ->label('Nomor Identitas')
                            ->required()
                            ->maxLength(20)
                            ->minLength(5)
                            ->regex('/^[0-9]+$/')
                            ->helperText('Hanya angka, 5-20 digit')
                            ->autocomplete('off')
                            ->afterStateHydrated(function (TextInput $component, $state) {
                                if ($state) {
                                    $component->state(preg_replace('/[^0-9]/', '', $state));
                                }
                            })
                            ->dehydrateStateUsing(fn($state) => preg_replace('/[^0-9]/', '', e($state))),
                    ])->columns(2),

                Section::make('Data Permohonan')
                    ->icon('heroicon-o-document')
                    ->description('Detail informasi yang diminta')
                    ->schema([
                        Textarea::make('informasi_diminta')
                            ->label('Informasi yang Diminta')
                            ->required()
                            ->rows(4)
                            ->minLength(10)
                            ->maxLength(2000)
                            ->helperText(fn($state) => new HtmlString(
                                '<span id="char-count-info">' . strlen($state ?? '') . '/2000 karakter</span>'
                            ))
                            ->autocomplete('off')
                            ->afterStateHydrated(function (Textarea $component, $state) {
                                if ($state) {
                                    $component->state(strip_tags(trim($state)));
                                }
                            })
                            ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),

                        Textarea::make('tujuan_penggunaan')
                            ->label('Tujuan Penggunaan')
                            ->required()
                            ->rows(3)
                            ->minLength(5)
                            ->maxLength(500)
                            ->autocomplete('off')
                            ->afterStateHydrated(function (Textarea $component, $state) {
                                if ($state) {
                                    $component->state(strip_tags(trim($state)));
                                }
                            })
                            ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),

                        Select::make('cara_mendapatkan')
                            ->label('Cara Mendapatkan Informasi')
                            ->required()
                            ->options([
                                'Pengambilan Langsung' => 'Pengambilan Langsung (di kantor)',
                                'Dimulai via Email' => 'Dimulai via Email',
                                'Faksimili' => 'Faksimili',
                                'Pos' => 'Pos',
                            ])
                            ->placeholder('Pilih cara memperoleh informasi'),
                    ])->columns(1),

                Section::make('Status & Catatan Admin')
                    ->icon('heroicon-o-cog')
                    ->description('Pengelolaan status permohonan (hanya untuk admin)')
                    ->collapsible()
                    ->schema([
                        Select::make('status')
                            ->label('Status Permohonan')
                            ->required()
                            ->options([
                                'masuk' => 'Masuk',
                                'diproses' => 'Sedang Diproses',
                                'selesai' => 'Selesai',
                                'ditolak' => 'Ditolak',
                                'banding' => 'Banding',
                            ])
                            ->default('masuk')
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if (in_array($state, ['selesai', 'ditolak'])) {
                                    $set('selesai_at', now());
                                }
                            }),

                        Textarea::make('catatan_admin')
                            ->label('Catatan Admin')
                            ->rows(3)
                            ->maxLength(1000)
                            ->helperText('Catatan internal untuk admin')
                            ->autocomplete('off')
                            ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),

                        Textarea::make('alasan_penolakan')
                            ->label('Alasan Penolakan')
                            ->rows(3)
                            ->maxLength(1000)
                            ->hidden(fn(Get $get) => $get('status') !== 'ditolak')
                            ->required(fn(Get $get) => $get('status') === 'ditolak')
                            ->helperText('Wajib diisi jika status ditolak')
                            ->autocomplete('off')
                            ->dehydrateStateUsing(fn($state) => e(strip_tags(trim($state)))),

                        DatePicker::make('deadline_at')
                            ->label('Deadline')
                            ->disabled()
                            ->helperText('Otomatis dihitung (+10 hari kerja)'),

                        DateTimePicker::make('selesai_at')
                            ->label('Tanggal Selesai')
                            ->disabled(),

                        TextInput::make('nomor_tiket')
                            ->label('Nomor Tiket')
                            ->disabled()
                            ->helperText('Otomatis generated saat permohonan dibuat'),
                    ])->columns(2),
            ]);
    }
}
