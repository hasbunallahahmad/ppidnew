<?php

namespace App\Services;

use App\Models\StatistikKearsipan;
use App\Models\StatistikKunjungan;

class StatistikService
{
    public function kearsipan(): array
    {
        $data = StatistikKearsipan::latest()->first();

        if (!$data) return [];

        return $data->toViewData();
    }

    public function kunjungan(): array
    {
        $records = StatistikKunjungan::ordered()->get(); // ← pakai scope urutan

        if ($records->isEmpty()) {
            return ['items' => [], 'total' => '0', 'diperbarui' => '-'];
        }

        $total = $records->sum('jumlah');

        return [
            'items' => $records->map(fn($k) => [
                'nama' => $k->nama,
                'jumlah' => $k->jumlah,
                'pct'    => $k->pct, // ← pakai accessor dari model, tidak perlu hitung ulang
            ])->toArray(),
            'total'      => number_format($total, 0, ',', '.'),
            'diperbarui' => $records->first()->updated_at
                ?->timezone('Asia/Jakarta')
                ->translatedFormat('F Y') ?? '-',
        ];
    }
}
