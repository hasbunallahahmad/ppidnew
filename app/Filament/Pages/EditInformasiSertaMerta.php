<?php

namespace App\Filament\Pages;

use App\Models\Page;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page as FilamentPage;

class EditInformasiSertaMerta extends FilamentPage
{
    protected static string|BackedEnum|null $navigationIcon = null;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Edit Informasi Serta Merta';

    protected static ?string $slug = 'informasi-serta-merta';

    public function getView(): string
    {
        return 'filament.pages.edit-informasi-serta-merta';
    }

    // ----------------------------------------------------------------
    // State
    // ----------------------------------------------------------------

    public string $pageTitle       = '';
    public string $pageDescription = '';
    public string $intro           = '';

    /** @var array<int, array> */
    public array $sections = [];

    // ----------------------------------------------------------------
    // Mount
    // ----------------------------------------------------------------

    public function mount(): void
    {
        $page = Page::where('slug', 'informasi-serta-merta')->firstOrFail();

        $this->pageTitle       = $page->title ?? '';
        $this->pageDescription = $page->description ?? '';

        $structured      = is_array($page->structured_content)
            ? $page->structured_content
            : json_decode($page->structured_content ?? '{}', true);

        $this->intro    = $structured['intro'] ?? '';
        $this->sections = $structured['sections'] ?? [];
    }

    // ----------------------------------------------------------------
    // Save
    // ----------------------------------------------------------------

    public function save(): void
    {
        $page = Page::where('slug', 'informasi-serta-merta')->firstOrFail();

        $structured = is_array($page->structured_content)
            ? $page->structured_content
            : json_decode($page->structured_content ?? '{}', true);

        $structured['intro']    = $this->intro;
        $structured['sections'] = $this->sections;

        $page->update([
            'title'              => $this->pageTitle,
            'description'        => $this->pageDescription,
            'structured_content' => $structured,
        ]);

        Notification::make()->title('Berhasil disimpan')->success()->send();
    }

    // ----------------------------------------------------------------
    // Section actions
    // ----------------------------------------------------------------

    public function addSection(): void
    {
        $this->sections[] = ['title' => '', 'items' => []];
    }

    public function removeSection(int $index): void
    {
        array_splice($this->sections, $index, 1);
        $this->sections = array_values($this->sections);
    }

    public function updateSectionTitle(int $index, string $value): void
    {
        $this->sections[$index]['title'] = $value;
    }

    // ----------------------------------------------------------------
    // Item actions
    // ----------------------------------------------------------------

    public function addItem(int $sectionIndex): void
    {
        $this->sections[$sectionIndex]['items'][] = ['label' => '', 'url' => '#'];
    }

    public function removeItem(int $sectionIndex, int $itemIndex): void
    {
        array_splice($this->sections[$sectionIndex]['items'], $itemIndex, 1);
        $this->sections[$sectionIndex]['items'] = array_values($this->sections[$sectionIndex]['items']);
    }

    public function updateItemLabel(int $sectionIndex, int $itemIndex, string $value): void
    {
        $this->sections[$sectionIndex]['items'][$itemIndex]['label'] = $value;
    }

    public function updateItemUrl(int $sectionIndex, int $itemIndex, string $value): void
    {
        $this->sections[$sectionIndex]['items'][$itemIndex]['url'] = $value;
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
