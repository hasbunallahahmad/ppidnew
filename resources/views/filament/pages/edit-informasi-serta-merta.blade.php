<x-filament-panels::page>

    {{-- INFORMASI HALAMAN --}}
    <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="flex items-center gap-3 px-6 py-4">
            <x-heroicon-o-document-text class="h-5 w-5 text-gray-400" />
            <h3 class="text-base font-semibold text-gray-950 dark:text-white">Informasi Halaman</h3>
        </div>
        <div class="border-t border-gray-200 dark:border-white/10 px-6 py-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Judul
                        Halaman</label>
                    <input type="text" wire:model="pageTitle"
                        class="fi-input block w-full rounded-lg border-0 py-2 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm dark:bg-white/5 dark:text-white dark:ring-white/10 px-3" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Deskripsi
                        Singkat</label>
                    <input type="text" wire:model="pageDescription"
                        class="fi-input block w-full rounded-lg border-0 py-2 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm dark:bg-white/5 dark:text-white dark:ring-white/10 px-3" />
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Teks
                        Pengantar</label>
                    <textarea wire:model="intro" rows="3"
                        class="fi-input block w-full rounded-lg border-0 py-2 text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm dark:bg-white/5 dark:text-white dark:ring-white/10 px-3"
                        placeholder="Deskripsi panjang yang tampil di atas daftar informasi..."></textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- DAFTAR SECTION --}}
    @foreach ($sections as $sectionIndex => $section)
        <div
            class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

            {{-- Section Header --}}
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <span style="background-color: rgb(var(--color-primary-600));"
                        class="inline-flex items-center justify-center w-7 h-7 rounded-full text-white text-xs font-bold flex-shrink-0">
                        {{ $sectionIndex + 1 }}
                    </span>
                    <input type="text" value="{{ $section['title'] }}"
                        wire:change="updateSectionTitle({{ $sectionIndex }}, $event.target.value)"
                        placeholder="Nama kategori..."
                        class="flex-1 rounded-lg border-0 py-1.5 px-3 text-sm font-semibold text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 dark:bg-white/5 dark:text-white dark:ring-white/10" />
                </div>
                <button wire:click="removeSection({{ $sectionIndex }})"
                    wire:confirm="Hapus kategori ini beserta semua item di dalamnya?" type="button"
                    class="ml-4 inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors flex-shrink-0">
                    <x-heroicon-o-trash class="h-4 w-4" />
                    Hapus Kategori
                </button>
            </div>

            {{-- Items Table --}}
            <div class="border-t border-gray-200 dark:border-white/10 overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead>
                        <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                            <th
                                style="padding: 10px 16px; text-align: center; width: 48px; color: #6b7280; font-size: 0.75rem; font-weight: 600;">
                                #</th>
                            <th
                                style="padding: 10px 16px; text-align: left; color: #6b7280; font-size: 0.75rem; font-weight: 600;">
                                Nama Informasi</th>
                            <th
                                style="padding: 10px 16px; text-align: left; width: 260px; color: #6b7280; font-size: 0.75rem; font-weight: 600;">
                                URL / Link</th>
                            <th
                                style="padding: 10px 16px; text-align: center; width: 80px; color: #6b7280; font-size: 0.75rem; font-weight: 600;">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($section['items'] ?? [] as $itemIndex => $item)
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding: 10px 16px; text-align: center; color: #9ca3af; font-size: 0.75rem;">
                                    {{ $itemIndex + 1 }}
                                </td>
                                <td style="padding: 8px 16px;">
                                    <input type="text" value="{{ $item['label'] }}"
                                        wire:change="updateItemLabel({{ $sectionIndex }}, {{ $itemIndex }}, $event.target.value)"
                                        placeholder="Nama informasi..."
                                        style="width: 100%; border-radius: 6px; border: 1px solid #d1d5db; padding: 6px 10px; font-size: 0.8rem; color: #111827;" />
                                </td>
                                <td style="padding: 8px 16px;">
                                    <input type="text" value="{{ $item['url'] ?? '#' }}"
                                        wire:change="updateItemUrl({{ $sectionIndex }}, {{ $itemIndex }}, $event.target.value)"
                                        placeholder="https://... atau #"
                                        style="width: 100%; border-radius: 6px; border: 1px solid #d1d5db; padding: 6px 10px; font-size: 0.75rem; font-family: monospace; color: #111827;" />
                                </td>
                                <td style="padding: 8px 16px; text-align: center;">
                                    <button wire:click="removeItem({{ $sectionIndex }}, {{ $itemIndex }})"
                                        type="button" title="Hapus item"
                                        style="color: #ef4444; padding: 4px; border-radius: 4px; background: none; border: none; cursor: pointer;"
                                        onmouseover="this.style.background='#fef2f2'"
                                        onmouseout="this.style.background='none'">
                                        <x-heroicon-o-trash class="h-4 w-4" />
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    style="padding: 20px 16px; text-align: center; color: #9ca3af; font-size: 0.8rem; font-style: italic;">
                                    Belum ada item. Klik "+ Tambah Item" untuk menambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Add Item --}}
            <div class="px-6 py-3 border-t border-gray-100 dark:border-white/5">
                <button wire:click="addItem({{ $sectionIndex }})" type="button"
                    class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-500 transition-colors">
                    <x-heroicon-o-plus-circle class="h-4 w-4" />
                    Tambah Item
                </button>
            </div>

        </div>
    @endforeach

    {{-- Add Section --}}
    <div>
        <button wire:click="addSection" type="button"
            class="w-full flex items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-300 dark:border-white/10 px-6 py-4 text-sm font-medium text-gray-500 dark:text-gray-400 hover:border-primary-400 hover:text-primary-600 transition-colors">
            <x-heroicon-o-plus class="h-5 w-5" />
            Tambah Kategori Baru
        </button>
    </div>

    {{-- Footer Save --}}
    <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="px-6 py-4 flex items-center justify-between">
            <p class="text-xs text-gray-400">
                {{ count($sections) }} kategori,
                {{ collect($sections)->sum(fn($s) => count($s['items'] ?? [])) }} item
            </p>
            <button wire:click="save" wire:loading.attr="disabled" wire:target="save" type="button"
                class="inline-flex items-center gap-2 rounded-lg px-5 py-2 text-sm font-semibold text-black shadow-sm transition-colors"
                style="background-color: rgb(var(--color-primary-600));">
                <x-heroicon-o-check class="h-4 w-4" wire:loading.remove wire:target="save" />
                <x-heroicon-o-arrow-path class="h-4 w-4 animate-spin hidden" wire:loading wire:target="save" />
                Simpan Perubahan
            </button>
        </div>
    </div>

</x-filament-panels::page>
