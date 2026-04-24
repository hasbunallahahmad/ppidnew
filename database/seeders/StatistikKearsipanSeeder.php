<?php

namespace Database\Seeders;

use App\Models\StatistikKearsipan;
use Illuminate\Database\Seeder;

class StatistikKearsipanSeeder extends Seeder
{
    public function run(): void
    {
        StatistikKearsipan::updateOrCreate(
            ['id' => 1],
            [
                'judul'          => 'Rekapitulasi Arsip Semester II 2024',
                'diperbarui'     => 'Maret 2025',
                'arsip_aktif'    => 12540,
                'arsip_inaktif'  => 8320,
                'arsip_statis'   => 4150,
                'arsip_vital'    => 1870,
                'arsip_digital'  => 6430,
            ]
        );
    }
}
