<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Halaman')
                    ->columnSpanFull()
                    ->components([
                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->helperText('Identitas unik halaman (contoh: tentang-dinas)')
                            ->disabled(),
                        TextInput::make('title')
                            ->label('Judul Halaman')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('description')
                            ->label('Deskripsi Singkat')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Deskripsi yang tampil di bawah judul'),
                    ]),

                // ============================================================
                // SECTION: Konten Informasi Berkala (hanya untuk slug = informasi-berkala)
                // Menggunakan structured_content (JSON) agar tidak dirusak RichEditor
                // ============================================================
                Section::make('Daftar Informasi Berkala')
                    ->columnSpanFull()
                    ->description('Kelola daftar informasi berkala per kategori. Setiap kategori dapat memiliki banyak item.')
                    ->visible(fn($record) => $record?->slug === 'informasi-berkala')
                    ->components([
                        Repeater::make('structured_content.sections')
                            ->label('Kategori Informasi')
                            ->addActionLabel('+ Tambah Kategori')
                            ->collapsible()
                            ->cloneable()
                            ->itemLabel(fn(array $state): ?string => $state['kategori'] ?? 'Kategori Baru')
                            ->schema([
                                TextInput::make('kategori')
                                    ->label('Nama Kategori')
                                    ->required()
                                    ->placeholder('Contoh: Laporan Kinerja Instansi Pemerintah')
                                    ->columnSpanFull(),

                                Repeater::make('items')
                                    ->label('Daftar Item')
                                    ->addActionLabel('+ Tambah Item')
                                    ->collapsible()
                                    ->itemLabel(fn(array $state): ?string => $state['jenis'] ?? 'Item Baru')
                                    ->schema([
                                        TextInput::make('jenis')
                                            ->label('Jenis Informasi')
                                            ->required()
                                            ->placeholder('Contoh: Laporan Kinerja (LKj) Tahun 2024')
                                            ->columnSpan(2),
                                        TextInput::make('url')
                                            ->label('URL / Link Dokumen')
                                            ->placeholder('https://... atau /storage/dokumen/file.pdf atau # jika belum tersedia')
                                            ->url()
                                            ->nullable()
                                            ->default('#')
                                            ->helperText('Isi "#" jika dokumen belum tersedia')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),
                    ]),

                // ============================================================
                // SECTION: Konten HTML Biasa (untuk semua halaman SELAIN informasi-berkala)
                // ============================================================
                Section::make('Konten')
                    ->columnSpanFull()
                    ->visible(fn($record) => $record?->slug !== 'informasi-berkala')
                    ->components([
                        RichEditor::make('content')
                            ->label('Isi Halaman')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('pages-content')
                            ->fileAttachmentsVisibility('public')
                            ->nullable()
                            ->floatingToolbars([
                                'paragraph' => [
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strike',
                                    'subscript',
                                    'superscript',
                                ],
                                'heading' => [
                                    'h1',
                                    'h2',
                                    'h3',
                                ],
                                'table' => [
                                    'tableAddColumnBefore',
                                    'tableAddColumnAfter',
                                    'tableDeleteColumn',
                                    'tableAddRowBefore',
                                    'tableAddRowAfter',
                                    'tableDeleteRow',
                                    'tableMergeCells',
                                    'tableSplitCell',
                                    'tableToggleHeaderRow',
                                    'tableToggleHeaderCell',
                                    'tableDelete',
                                ],
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('File PDF')
                    ->columnSpanFull()
                    ->components([
                        FileUpload::make('pdf_file')
                            ->label('Upload PDF')
                            ->disk('public')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10240)
                            ->directory('pages-pdf')
                            ->nullable()
                            ->helperText('Upload file PDF untuk halaman. Max size: 10MB'),
                    ]),
            ]);
    }
}
