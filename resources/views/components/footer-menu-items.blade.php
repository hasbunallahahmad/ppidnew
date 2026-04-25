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
    @php
        // FIX: URL dari DB divalidasi dengan safe_url()
        // target juga divalidasi — hanya '_blank' atau '_self'
        $safeUrl = safe_url($item->url);
        $itemTarget = $item->target === '_blank' ? '_blank' : '_self';
    @endphp
    <li>
        <a href="{{ $safeUrl }}" target="{{ $itemTarget }}"
            @if ($itemTarget === '_blank') rel="noopener noreferrer" @endif>
            <i class="fas fa-chevron-right"></i>
            {{ $item->title }}
        </a>
    </li>
@empty
    @foreach ($defaultItems as $item)
        @php
            // FIX: URL dari array hardcoded juga divalidasi untuk konsistensi
            // (array hardcoded relatif aman, tapi best practice tetap divalidasi)
            $safeUrl = safe_url($item['url']);
            $itemTarget = ($item['target'] ?? '_self') === '_blank' ? '_blank' : '_self';
        @endphp
        <li>
            <a href="{{ $safeUrl }}" target="{{ $itemTarget }}"
                @if ($itemTarget === '_blank') rel="noopener noreferrer" @endif>
                <i class="fas fa-chevron-right"></i>
                {{ $item['label'] }}
            </a>
        </li>
    @endforeach
@endforelse
