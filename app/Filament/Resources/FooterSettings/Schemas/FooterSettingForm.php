<?php

namespace App\Filament\Resources\FooterSettings\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FooterSettingForm
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
                            ->unique('footer_settings', 'slug', ignoreRecord: true)
                            ->helperText('Auto-generated dari nama brand untuk keamanan sistem. Jangan ubah kecuali diperlukan.')
                            ->rules('regex:/^[a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?$/')
                            ->disabled(fn($record) => $record?->id === 1),
                    ]),

                Section::make('Brand & Deskripsi')
                    ->icon('heroicon-o-building-storefront')
                    ->columns(2)
                    ->schema([
                        TextInput::make('brand_name')
                            ->label('Nama Brand/Organisasi')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('tagline')
                            ->label('Tagline/Deskripsi Singkat')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),

                Section::make('Media Sosial')
                    ->icon('heroicon-o-share')
                    ->columns(2)
                    ->schema([
                        TextInput::make('social_facebook')
                            ->label('URL Facebook')
                            ->url()
                            ->placeholder('https://facebook.com/...'),

                        TextInput::make('social_twitter')
                            ->label('URL Twitter/X')
                            ->url()
                            ->placeholder('https://twitter.com/...'),

                        TextInput::make('social_instagram')
                            ->label('URL Instagram')
                            ->url()
                            ->placeholder('https://instagram.com/...'),

                        TextInput::make('social_youtube')
                            ->label('URL YouTube')
                            ->url()
                            ->placeholder('https://youtube.com/...'),
                    ]),

                Section::make('Sertifikat & Penghargaan')
                    ->icon('heroicon-o-star')
                    ->columns(2)
                    ->schema([
                        TextInput::make('cert_1_text')
                            ->label('Sertifikat 1 - Teks/Nama')
                            ->placeholder('Contoh: ISO 9001:2015'),

                        TextInput::make('cert_1_icon')
                            ->label('Sertifikat 1 - Icon Class')
                            ->placeholder('Contoh: heroicon-o-star')
                            ->helperText('Gunakan heroicon class atau custom CSS class'),

                        TextInput::make('cert_2_text')
                            ->label('Sertifikat 2 - Teks/Nama')
                            ->placeholder('Contoh: ISO 27001:2013'),

                        TextInput::make('cert_2_icon')
                            ->label('Sertifikat 2 - Icon Class')
                            ->placeholder('Contoh: heroicon-o-shield-check')
                            ->helperText('Gunakan heroicon class atau custom CSS class'),
                    ]),

                Section::make('Informasi Kontak')
                    ->icon('heroicon-o-envelope')
                    ->columns(2)
                    ->description('Informasi dasar footer. Menu items diatur di Menu Manager → Footer sections.')
                    ->schema([
                        TextInput::make('contact_address')
                            ->label('Alamat')
                            ->columnSpanFull()
                            ->placeholder('Jl. Contoh No. 123, Jakarta'),

                        TextInput::make('contact_phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->placeholder('(021) 1234 5678'),

                        TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->placeholder('info@example.com'),

                        TextInput::make('contact_fax')
                            ->label('Nomor Fax')
                            ->placeholder('(021) 1234 5679'),

                        Textarea::make('contact_hours')
                            ->label('Jam Operasional')
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Senin - Jumat: 08:00 - 17:00
Sabtu: 08:00 - 12:00
Minggu & Hari Libur: Tutup'),
                    ]),

                Section::make('Copyright & Footer')
                    ->icon('heroicon-o-information-circle')
                    ->columns(1)
                    ->schema([
                        Textarea::make('footer_copyright')
                            ->label('Teks Copyright')
                            ->rows(2)
                            ->columnSpanFull()
                            ->placeholder('© 2024 Nama Organisasi. Semua hak dilindungi undang-undang.'),
                    ]),
            ]);
    }
}
