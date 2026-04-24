<?php

namespace App\Filament\Pages;

use App\Models\Page;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page as FilamentPage;

class EditInformasiSetiapSaat extends FilamentPage
{
    protected static string|BackedEnum|null $navigationIcon = null;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Edit Informasi Setiap Saat';

    protected static ?string $slug = 'informasi-setiap-saat';

    public function getView(): string
    {
        return 'filament.pages.edit-informasi-setiap-saat';
    }

    // ----------------------------------------------------------------
    // State
    // ----------------------------------------------------------------

    /** @var array<int, array> */
    public array $rows = [];

    public string $pageTitle = '';
    public string $pageDescription = '';

    // ----------------------------------------------------------------
    // Mount — load data dari DB
    // ----------------------------------------------------------------

    public function mount(): void
    {
        $page = Page::where('slug', 'informasi-setiap-saat')->firstOrFail();

        $this->pageTitle       = $page->title ?? '';
        $this->pageDescription = $page->description ?? '';

        $structured = is_array($page->structured_content)
            ? $page->structured_content
            : json_decode($page->structured_content ?? '{}', true);

        $this->rows = $structured['rows'] ?? [];
    }

    // ----------------------------------------------------------------
    // Save
    // ----------------------------------------------------------------

    public function save(): void
    {
        $page = Page::where('slug', 'informasi-setiap-saat')->firstOrFail();

        // Ambil structured_content lama agar key lain tidak hilang
        $structured         = is_array($page->structured_content)
            ? $page->structured_content
            : json_decode($page->structured_content ?? '{}', true);

        $structured['rows'] = $this->rows;

        $page->update([
            'title'              => $this->pageTitle,
            'description'        => $this->pageDescription,
            'structured_content' => $structured,
        ]);

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
    }

    // ----------------------------------------------------------------
    // Helper: update URL item dalam row tanpa sub
    // ----------------------------------------------------------------

    public function updateItemUrl(int $rowIndex, int $itemIndex, string $value): void
    {
        $this->rows[$rowIndex]['items'][$itemIndex]['url'] = $value;
    }

    // ----------------------------------------------------------------
    // Helper: update URL item dalam sub
    // ----------------------------------------------------------------

    public function updateSubItemUrl(int $rowIndex, int $subIndex, int $itemIndex, string $value): void
    {
        $this->rows[$rowIndex]['sub'][$subIndex]['items'][$itemIndex]['url'] = $value;
    }

    // ----------------------------------------------------------------
    // Helper: update keterangan (HTML string)
    // ----------------------------------------------------------------

    public function updateKeterangan(int $rowIndex, string $value): void
    {
        $this->rows[$rowIndex]['keterangan'] = $value;
    }

    // ----------------------------------------------------------------
    // Header actions
    // ----------------------------------------------------------------

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Kembali ke Daftar')
                ->url(fn() => \App\Filament\Resources\Pages\PageResource::getUrl('index'))
                ->color('gray')
                ->icon('heroicon-o-arrow-left'),

            Action::make('save')
                ->label('Simpan')
                ->action('save')
                ->color('primary')
                ->icon('heroicon-o-check'),
        ];
    }
}
