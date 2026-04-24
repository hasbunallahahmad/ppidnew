<?php

namespace App\Filament\Resources\PermohonanInformasi\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PermohonanInformasiInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ─── DATA PEMOHON ────────────────────────────────────────────
                Section::make('Data Pemohon')
                    ->icon('heroicon-o-user')
                    ->description('Informasi pribadi pemohon')
                    ->schema([
                        TextEntry::make('nama_pemohon')
                            ->label('Nama Lengkap'),

                        TextEntry::make('email')
                            ->label('Email')
                            ->private()
                            ->privacyMode('blur_click'),

                        TextEntry::make('no_telepon')
                            ->label('Nomor Telepon')
                            ->private()
                            ->privacyMode('mask')
                            ->maskUsing('phone'),

                        TextEntry::make('alamat')
                            ->label('Alamat Lengkap')
                            ->private()
                            ->privacyMode('blur_click')
                            ->columnSpanFull(),

                        TextEntry::make('jenis_identitas')
                            ->label('Jenis Identitas'),

                        TextEntry::make('no_identitas')
                            ->label('Nomor Identitas')
                            ->private()
                            ->privacyMode('mask')
                            ->maskUsing('nik'),
                    ])->columns(2),

                // ─── DATA PERMOHONAN ─────────────────────────────────────────
                Section::make('Data Permohonan')
                    ->icon('heroicon-o-document')
                    ->description('Detail informasi yang diminta')
                    ->schema([
                        TextEntry::make('informasi_diminta')
                            ->label('Informasi yang Diminta')
                            ->columnSpanFull(),

                        TextEntry::make('tujuan_penggunaan')
                            ->label('Tujuan Penggunaan')
                            ->columnSpanFull(),

                        TextEntry::make('cara_mendapatkan')
                            ->label('Cara Mendapatkan Informasi'),
                    ])->columns(1),

                // ─── STATUS & ADMIN ──────────────────────────────────────────
                Section::make('Status & Catatan Admin')
                    ->icon('heroicon-o-cog')
                    ->description('Pengelolaan status permohonan')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('nomor_tiket')
                            ->label('Nomor Tiket')
                            ->copyable(),

                        TextEntry::make('status')
                            ->label('Status Permohonan')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'masuk'    => 'info',
                                'diproses' => 'warning',
                                'selesai'  => 'success',
                                'ditolak'  => 'danger',
                                'banding'  => 'gray',
                                default    => 'gray',
                            })
                            ->formatStateUsing(fn(string $state): string => match ($state) {
                                'masuk'    => 'Masuk',
                                'diproses' => 'Sedang Diproses',
                                'selesai'  => 'Selesai',
                                'ditolak'  => 'Ditolak',
                                'banding'  => 'Banding',
                                default    => $state,
                            }),

                        TextEntry::make('deadline_at')
                            ->label('Deadline')
                            ->date('d M Y'),

                        TextEntry::make('selesai_at')
                            ->label('Tanggal Selesai')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),

                        TextEntry::make('catatan_admin')
                            ->label('Catatan Admin')
                            ->columnSpanFull()
                            ->placeholder('Tidak ada catatan'),

                        TextEntry::make('alasan_penolakan')
                            ->label('Alasan Penolakan')
                            ->columnSpanFull()
                            ->placeholder('-')
                            ->visible(fn($record) => $record?->status === 'ditolak'),
                    ])->columns(2),
            ]);
    }
}
