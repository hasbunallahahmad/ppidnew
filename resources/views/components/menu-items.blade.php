@php
    use NoteBrainsLab\FilamentMenuManager\Models\Menu;

    $mainMenu = Menu::query()
        ->whereHas('location', function ($query) {
            $query->where('handle', 'main_menu');
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
@endphp

@if ($mainMenu?->items)
    @foreach ($mainMenu->items as $item)
        @php
            // FIX: validasi target dari DB — hanya izinkan '_blank' atau '_self'
            // untuk mencegah penyalahgunaan nilai target bebas dari database
            $itemTarget = $item->target === '_blank' ? '_blank' : '_self';
        @endphp
        <li class="nav-item @if ($item->children && $item->children->count() > 0) has-dropdown @endif">
            {{-- FIX: semua URL menu berasal dari DB, wajib divalidasi dengan safe_url()
                 untuk mencegah injeksi javascript:, data:, vbscript: --}}
            <a href="{{ safe_url($item->url) }}" target="{{ $itemTarget }}"
                @if ($itemTarget === '_blank') rel="noopener noreferrer" @endif
                class="nav-link @if (request()->is('/')) active @endif">
                {{ $item->title }}
                @if ($item->children && $item->children->count() > 0)
                    <i class="fas fa-chevron-down"></i>
                @endif
            </a>

            @if ($item->children && $item->children->count() > 0)
                <ul class="dropdown-menu">
                    @foreach ($item->children->sortBy('order') as $child)
                        @php
                            // FIX: validasi target child menu juga
                            $childTarget = $child->target === '_blank' ? '_blank' : '_self';
                        @endphp
                        <li>
                            {{-- FIX: URL child menu juga divalidasi dengan safe_url() --}}
                            <a href="{{ safe_url($child->url) }}" target="{{ $childTarget }}"
                                @if ($childTarget === '_blank') rel="noopener noreferrer" @endif>
                                @if ($child->icon)
                                    <i class="{{ $child->icon }}"></i>
                                @endif
                                {{ $child->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
@endif
