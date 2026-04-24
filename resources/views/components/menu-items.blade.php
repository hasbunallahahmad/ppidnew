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
        <li class="nav-item @if ($item->children && $item->children->count() > 0) has-dropdown @endif">
            <a href="{{ $item->url }}" target="{{ $item->target ?? '_self' }}"
                class="nav-link @if (request()->is('/')) active @endif">
                {{ $item->title }}
                @if ($item->children && $item->children->count() > 0)
                    <i class="fas fa-chevron-down"></i>
                @endif
            </a>

            @if ($item->children && $item->children->count() > 0)
                <ul class="dropdown-menu">
                    @foreach ($item->children->sortBy('order') as $child)
                        <li>
                            <a href="{{ $child->url }}" target="{{ $child->target ?? '_self' }}">
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
