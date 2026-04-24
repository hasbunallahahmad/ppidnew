@php
    use NoteBrainsLab\FilamentMenuManager\Models\Menu;

    $handle = $section ?? 'footer_section_1';

    $menu = Menu::query()
        ->whereHas('location', function ($query) use ($handle) {
            $query->where('handle', $handle);
        })
        ->with([
            'items' => function ($query) {
                $query
                    ->whereNull('parent_id')
                    ->where('enabled', true)
                    ->orderBy('order')
                    ->with([
                        'children' => function ($childQuery) {
                            $childQuery->where('enabled', true)->orderBy('order');
                        },
                    ]);
            },
        ])
        ->first();

    $defaultItems = match ($handle) {
        'footer_section_1' => [
            [
                'label' => 'Arsip Digital',
                'url' => 'https://selaras.semarangkota.go.id/',
                'target' => '_blank',
            ],
        ],
        'footer_section_2' => [
            [
                'label' => 'Katalog Koleksi',
                'url' => 'https://perpustakaan.semarangkota.go.id/opac/',
                'target' => '_blank',
            ],
            [
                'label' => 'E-Library & E-Book',
                'url' => 'https://sibooky.semarangkota.go.id/',
                'target' => '_blank',
            ],
        ],
        'footer_section_3' => [
            ['label' => 'Kebijakan Privasi', 'url' => '#'],
            ['label' => 'Syarat Penggunaan', 'url' => '#'],
            ['label' => 'Aksesibilitas', 'url' => '#'],
            ['label' => 'Peta Situs', 'url' => '#'],
        ],
        default => [],
    };

    $items = $menu?->items ?? [];
@endphp

@forelse($items as $item)
    <li><a href="{{ $item->url }}" target="{{ $item->target ?? '_self' }}"><i class="fas fa-chevron-right"></i>
            {{ $item->title }}</a></li>
@empty
    @foreach ($defaultItems as $item)
        <li><a href="{{ $item['url'] }}" target="{{ $item['target'] ?? '_self' }}"><i class="fas fa-chevron-right"></i>
                {{ $item['label'] }}</a></li>
    @endforeach
@endforelse
