<x-filament-panels::page>

    {{-- INFORMASI HALAMAN --}}
    <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="fi-section-header flex items-center gap-3 px-6 py-4">
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
            </div>
        </div>
    </div>

    {{-- TABEL DAFTAR INFORMASI --}}
    <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

        <div class="flex items-center gap-3 px-6 py-4">
            <x-heroicon-o-table-cells class="h-5 w-5 text-gray-400" />
            <div>
                <h3 class="text-base font-semibold text-gray-950 dark:text-white">Daftar Informasi Setiap Saat</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                    Edit URL pada kolom <strong>Keterangan / URL</strong>.
                    Isi <code class="bg-gray-100 dark:bg-gray-800 px-1 rounded">#</code> jika belum tersedia.
                </p>
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-white/10 overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr style="background-color: rgb(var(--color-primary-600)); color: white;">
                        <th class="px-4 py-3 text-center font-semibold w-12"
                            style="border-right: 1px solid rgba(255,255,255,0.2);">No</th>
                        <th class="px-4 py-3 text-left font-semibold w-72"
                            style="border-right: 1px solid rgba(255,255,255,0.2);">Jenis Informasi</th>
                        <th class="px-4 py-3 text-left font-semibold w-52"
                            style="border-right: 1px solid rgba(255,255,255,0.2);">Rincian Informasi</th>
                        <th class="px-4 py-3 text-left font-semibold">Keterangan / URL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $rowIndex => $row)
                        @php
                            $hasSub = !empty($row['sub']);
                            $hasItems = !empty($row['items']);

                            $totalRows = 0;
                            if ($hasSub) {
                                foreach ($row['sub'] as $sub) {
                                    $totalRows += max(1, count($sub['items'] ?? []));
                                }
                            } elseif ($hasItems) {
                                $totalRows = count($row['items']);
                            } else {
                                $totalRows = 1;
                            }
                            $totalRows = max(1, $totalRows);
                            $isFirst = true;
                        @endphp

                        @if ($hasSub)
                            @foreach ($row['sub'] as $subIndex => $sub)
                                @php
                                    $subItems = $sub['items'] ?? [];
                                    $subRowspan = max(1, count($subItems));
                                    $isFirstSub = true;
                                @endphp

                                @if (!empty($subItems))
                                    @foreach ($subItems as $itemIndex => $item)
                                        <tr style="border-bottom: 1px solid #f3f4f6;">
                                            @if ($isFirst && $isFirstSub && $loop->first)
                                                <td rowspan="{{ $totalRows }}"
                                                    style="border-right: 1px solid #f3f4f6; background: #f9fafb; vertical-align: middle; text-align: center; font-weight: 700; color: #374151; padding: 12px 16px;">
                                                    {{ $row['no'] ?? $rowIndex + 1 }}
                                                </td>
                                                <td rowspan="{{ $totalRows }}"
                                                    style="border-right: 1px solid #f3f4f6; vertical-align: middle; padding: 12px 16px; color: #374151; font-size: 0.75rem; line-height: 1.5;">
                                                    {{ $row['jenis'] }}
                                                </td>
                                                @php $isFirst = false; @endphp
                                            @endif

                                            @if ($loop->first)
                                                <td rowspan="{{ $subRowspan }}"
                                                    style="border-right: 1px solid #f3f4f6; background: #f9fafb; vertical-align: middle; padding: 12px 16px; font-weight: 500; color: #4b5563; font-size: 0.75rem;">
                                                    {{ $sub['rincian'] }}
                                                </td>
                                                @php $isFirstSub = false; @endphp
                                            @endif

                                            <td style="padding: 8px 16px;">
                                                <div class="flex items-center gap-3">
                                                    <span
                                                        style="font-size: 0.75rem; color: #6b7280; flex: 1; min-width: 0;">{{ $item['label'] }}</span>
                                                    <input type="text" value="{{ $item['url'] ?? '#' }}"
                                                        wire:change="updateSubItemUrl({{ $rowIndex }}, {{ $subIndex }}, {{ $itemIndex }}, $event.target.value)"
                                                        placeholder="https://... atau #"
                                                        style="width: 220px; flex-shrink: 0; border-radius: 6px; border: 1px solid #d1d5db; padding: 4px 10px; font-size: 0.7rem; font-family: monospace; color: #111827; background: white;" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    {{-- Sub tanpa items --}}
                                    <tr style="border-bottom: 1px solid #f3f4f6;">
                                        @if ($isFirst)
                                            <td rowspan="{{ $totalRows }}"
                                                style="border-right: 1px solid #f3f4f6; background: #f9fafb; vertical-align: middle; text-align: center; font-weight: 700; color: #374151; padding: 12px 16px;">
                                                {{ $row['no'] ?? $rowIndex + 1 }}
                                            </td>
                                            <td rowspan="{{ $totalRows }}"
                                                style="border-right: 1px solid #f3f4f6; vertical-align: middle; padding: 12px 16px; color: #374151; font-size: 0.75rem; line-height: 1.5;">
                                                {{ $row['jenis'] }}
                                            </td>
                                            @php $isFirst = false; @endphp
                                        @endif
                                        <td
                                            style="border-right: 1px solid #f3f4f6; background: #f9fafb; vertical-align: middle; padding: 12px 16px; font-weight: 500; color: #4b5563; font-size: 0.75rem;">
                                            {{ $sub['rincian'] }}
                                        </td>
                                        <td style="padding: 8px 16px;">
                                            @if (!empty($sub['keterangan']))
                                                <textarea rows="2"
                                                    style="width: 100%; border-radius: 6px; border: 1px solid #d1d5db; padding: 6px 10px; font-size: 0.7rem; font-family: monospace; color: #111827; resize: vertical;">{{ $sub['keterangan'] }}</textarea>
                                            @else
                                                <span style="color: #d1d5db; font-size: 0.75rem;">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @elseif ($hasItems)
                            @foreach ($row['items'] as $itemIndex => $item)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    @if ($loop->first)
                                        <td rowspan="{{ $totalRows }}"
                                            style="border-right: 1px solid #f3f4f6; background: #f9fafb; vertical-align: middle; text-align: center; font-weight: 700; color: #374151; padding: 12px 16px;">
                                            {{ $row['no'] ?? $rowIndex + 1 }}
                                        </td>
                                        <td rowspan="{{ $totalRows }}"
                                            style="border-right: 1px solid #f3f4f6; vertical-align: middle; padding: 12px 16px; color: #374151; font-size: 0.75rem; line-height: 1.5;">
                                            {{ $row['jenis'] }}
                                        </td>
                                    @endif
                                    <td
                                        style="border-right: 1px solid #f3f4f6; background: #f9fafb; padding: 12px 16px;">
                                        <span style="color: #d1d5db;">—</span>
                                    </td>
                                    <td style="padding: 8px 16px;">
                                        <div class="flex items-center gap-3">
                                            <span
                                                style="font-size: 0.75rem; color: #6b7280; flex: 1; min-width: 0;">{{ $item['label'] }}</span>
                                            <input type="text" value="{{ $item['url'] ?? '#' }}"
                                                wire:change="updateItemUrl({{ $rowIndex }}, {{ $itemIndex }}, $event.target.value)"
                                                placeholder="https://... atau #"
                                                style="width: 220px; flex-shrink: 0; border-radius: 6px; border: 1px solid #d1d5db; padding: 4px 10px; font-size: 0.7rem; font-family: monospace; color: #111827; background: white;" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            {{-- Hanya keterangan HTML --}}
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td
                                    style="border-right: 1px solid #f3f4f6; background: #f9fafb; text-align: center; font-weight: 700; color: #374151; padding: 12px 16px; vertical-align: middle;">
                                    {{ $row['no'] ?? $rowIndex + 1 }}
                                </td>
                                <td
                                    style="border-right: 1px solid #f3f4f6; padding: 12px 16px; color: #374151; font-size: 0.75rem; line-height: 1.5; vertical-align: middle;">
                                    {{ $row['jenis'] }}
                                </td>
                                <td
                                    style="border-right: 1px solid #f3f4f6; background: #f9fafb; padding: 12px 16px; vertical-align: middle;">
                                    <span style="color: #d1d5db;">—</span>
                                </td>
                                <td style="padding: 8px 16px;">
                                    <textarea wire:model="rows.{{ $rowIndex }}.keterangan" rows="3"
                                        placeholder="Isi keterangan di sini (teks biasa)..."
                                        style="width: 100%; border-radius: 6px; border: 1px solid #d1d5db; padding: 6px 10px; font-size: 0.75rem; color: #111827; resize: vertical;"></textarea>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="border-t border-gray-200 dark:border-white/10 px-6 py-4 flex items-center justify-between">
            <p class="text-xs text-gray-400">{{ count($rows) }} jenis informasi</p>
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
