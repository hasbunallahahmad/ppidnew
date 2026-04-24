<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikKearsipan extends Model
{
    protected $table = 'statistik_kearsipan';

    protected $fillable = [
        'judul',
        'diperbarui',
        'arsip_aktif',
        'arsip_inaktif',
        'arsip_statis',
        'arsip_vital',
        'arsip_digital',
    ];

    protected $casts = [
        'arsip_aktif'    => 'integer',
        'arsip_inaktif'  => 'integer',
        'arsip_statis'   => 'integer',
        'arsip_vital'    => 'integer',
        'arsip_digital'  => 'integer',
    ];

    public function toViewData(): array
    {
        $items = [
            ['nama' => 'Arsip Aktif',    'jumlah' => $this->arsip_aktif,   'satuan' => 'berkas'],
            ['nama' => 'Arsip Inaktif',  'jumlah' => $this->arsip_inaktif, 'satuan' => 'berkas'],
            ['nama' => 'Arsip Statis',   'jumlah' => $this->arsip_statis,  'satuan' => 'berkas'],
            ['nama' => 'Arsip Vital',    'jumlah' => $this->arsip_vital,   'satuan' => 'berkas'],
            ['nama' => 'Arsip Digital',  'jumlah' => $this->arsip_digital, 'satuan' => 'file'],
        ];

        $max = collect($items)->max('jumlah') ?: 1;

        return [
            'judul'      => $this->judul,
            'diperbarui' => $this->diperbarui,
            'link'       => $this->link ?? '#',
            'items'      => collect($items)->map(fn($item) => [
                ...$item,
                'pct' => round(($item['jumlah'] / $max) * 100),
            ])->toArray(),
            'ringkasan'  => [
                [
                    'nilai' => number_format(
                        $this->arsip_aktif + $this->arsip_inaktif +
                            $this->arsip_statis + $this->arsip_vital,
                        0,
                        ',',
                        '.'
                    ),
                    'label' => 'Total Arsip Fisik',
                ],
                [
                    'nilai' => number_format($this->arsip_digital, 0, ',', '.'),
                    'label' => 'Arsip Digital',
                ],
            ],
        ];
    }
}
