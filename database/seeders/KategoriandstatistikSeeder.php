<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriAndStatistikSeeder extends Seeder
{
    public function run(): void
    {
        // ================================================================
        // KATEGORIS
        // ================================================================
        $kategoris = [
            // -- Kategori Berita --
            ['nama' => 'Pemerintahan',  'tipe' => 'berita', 'warna' => 'blue',   'icon' => 'fas fa-landmark',        'urutan' => 1],
            ['nama' => 'Infrastruktur', 'tipe' => 'berita', 'warna' => 'orange', 'icon' => 'fas fa-road',             'urutan' => 2],
            ['nama' => 'Kesehatan',     'tipe' => 'berita', 'warna' => 'red',    'icon' => 'fas fa-heartbeat',        'urutan' => 3],
            ['nama' => 'Pendidikan',    'tipe' => 'berita', 'warna' => 'green',  'icon' => 'fas fa-graduation-cap',   'urutan' => 4],
            ['nama' => 'Lingkungan',    'tipe' => 'berita', 'warna' => 'teal',   'icon' => 'fas fa-leaf',             'urutan' => 5],
            ['nama' => 'Ekonomi',       'tipe' => 'berita', 'warna' => 'yellow', 'icon' => 'fas fa-chart-line',       'urutan' => 6],
            ['nama' => 'Sosial',        'tipe' => 'berita', 'warna' => 'purple', 'icon' => 'fas fa-users',            'urutan' => 7],
            ['nama' => 'Pengumuman',    'tipe' => 'berita', 'warna' => 'gray',   'icon' => 'fas fa-bullhorn',         'urutan' => 8],

            // -- Kategori Dokumen --
            ['nama' => 'Peraturan Daerah',      'tipe' => 'dokumen', 'warna' => 'blue',   'icon' => 'fas fa-gavel',           'urutan' => 1],
            ['nama' => 'Surat Keputusan',        'tipe' => 'dokumen', 'warna' => 'green',  'icon' => 'fas fa-file-signature',  'urutan' => 2],
            ['nama' => 'LKPJ & LPPD',            'tipe' => 'dokumen', 'warna' => 'teal',   'icon' => 'fas fa-clipboard-list',  'urutan' => 3],
            ['nama' => 'APBD',                   'tipe' => 'dokumen', 'warna' => 'orange', 'icon' => 'fas fa-coins',           'urutan' => 4],
            ['nama' => 'Rencana Kerja',          'tipe' => 'dokumen', 'warna' => 'purple', 'icon' => 'fas fa-tasks',           'urutan' => 5],
            ['nama' => 'Laporan Kegiatan',       'tipe' => 'dokumen', 'warna' => 'red',    'icon' => 'fas fa-file-alt',        'urutan' => 6],
            ['nama' => 'Standar Layanan',        'tipe' => 'dokumen', 'warna' => 'gray',   'icon' => 'fas fa-certificate',     'urutan' => 7],
            ['nama' => 'Perjanjian Kerjasama',   'tipe' => 'dokumen', 'warna' => 'blue',   'icon' => 'fas fa-handshake',       'urutan' => 8],

            // -- Kategori Infografis --
            ['nama' => 'Statistik',       'tipe' => 'infografis', 'warna' => 'blue',   'icon' => 'fas fa-chart-bar',      'urutan' => 1],
            ['nama' => 'Kependudukan',    'tipe' => 'infografis', 'warna' => 'green',  'icon' => 'fas fa-users',          'urutan' => 2],
            ['nama' => 'Pembangunan',     'tipe' => 'infografis', 'warna' => 'orange', 'icon' => 'fas fa-hard-hat',       'urutan' => 3],
            ['nama' => 'Layanan Publik',  'tipe' => 'infografis', 'warna' => 'teal',   'icon' => 'fas fa-concierge-bell', 'urutan' => 4],
        ];

        foreach ($kategoris as $k) {
            DB::table('kategoris')->insertOrIgnore([
                'nama'       => $k['nama'],
                'slug'       => Str::slug($k['nama']),
                'tipe'       => $k['tipe'],
                'warna'      => $k['warna'],
                'icon'       => $k['icon'],
                'is_active'  => true,
                'urutan'     => $k['urutan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ================================================================
        // STATISTIK KUNJUNGAN — Semester II 2024
        // ================================================================
        $kunjungans = [
            ['nama' => 'Juli 2024',      'jumlah' => 7820, 'urutan' => 1],
            ['nama' => 'Agustus 2024',   'jumlah' => 9145, 'urutan' => 2],
            ['nama' => 'September 2024', 'jumlah' => 8430, 'urutan' => 3],
            ['nama' => 'Oktober 2024',   'jumlah' => 8760, 'urutan' => 4],
            ['nama' => 'November 2024',  'jumlah' => 7920, 'urutan' => 5],
            ['nama' => 'Desember 2024',  'jumlah' => 8065, 'urutan' => 6],
        ];

        $periode            = 'semester_2_2024';
        $keteranganPeriode  = 'Kunjungan Perpustakaan Semester II 2024';

        foreach ($kunjungans as $k) {
            DB::table('statistik_kunjungans')->insertOrIgnore([
                'nama'                => $k['nama'],
                'jumlah'              => $k['jumlah'],
                'periode'             => $periode,
                'keterangan_periode'  => $keteranganPeriode,
                'urutan'              => $k['urutan'],
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }

        // ================================================================
        // LAYANANS — 6 card default homepage
        // ================================================================
        $layanans = [
            [
                'judul' => 'Berita & Pengumuman',
                'icon' => 'fas fa-newspaper',
                'warna' => 'blue',
                'jumlah_label' => '0 artikel',
                'url' => '#',
                'urutan' => 1,
                'deskripsi' => 'Berita resmi, siaran pers, dan pengumuman terkini dari pemerintah Kota Semarang.'
            ],
            [
                'judul' => 'Data & Statistik',
                'icon' => 'fas fa-chart-bar',
                'warna' => 'green',
                'jumlah_label' => '0 dataset',
                'url' => '#',
                'urutan' => 2,
                'deskripsi' => 'Data statistik kependudukan, ekonomi, kesehatan, dan pembangunan Kota Semarang.'
            ],
            [
                'judul' => 'Infografis',
                'icon' => 'fas fa-images',
                'warna' => 'orange',
                'jumlah_label' => '0 infografis',
                'url' => '#',
                'urutan' => 3,
                'deskripsi' => 'Penyajian informasi dalam bentuk visual yang informatif dan mudah dipahami.'
            ],
            [
                'judul' => 'Tabel & Rekapitulasi',
                'icon' => 'fas fa-table',
                'warna' => 'teal',
                'jumlah_label' => '0 tabel',
                'url' => '#',
                'urutan' => 4,
                'deskripsi' => 'Data rekapitulasi berbagai bidang dalam format tabel yang terstruktur.'
            ],
            [
                'judul' => 'Dokumen Resmi',
                'icon' => 'fas fa-file-pdf',
                'warna' => 'red',
                'jumlah_label' => '0 dokumen',
                'url' => '#',
                'urutan' => 5,
                'deskripsi' => 'Peraturan daerah, SK, LKPJ, APBD, dan berbagai dokumen resmi pemerintah.'
            ],
            [
                'judul' => 'Video & Multimedia',
                'icon' => 'fas fa-video',
                'warna' => 'purple',
                'jumlah_label' => '0 video',
                'url' => '#',
                'urutan' => 6,
                'deskripsi' => 'Konten video, siaran langsung, dan arsip multimedia kegiatan pemerintahan.'
            ],
        ];

        foreach ($layanans as $l) {
            DB::table('layanans')->insertOrIgnore([
                'judul'        => $l['judul'],
                'deskripsi'    => $l['deskripsi'],
                'icon'         => $l['icon'],
                'warna'        => $l['warna'],
                'url'          => $l['url'],
                'jumlah_label' => $l['jumlah_label'],
                'is_active'    => true,
                'urutan'       => $l['urutan'],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
