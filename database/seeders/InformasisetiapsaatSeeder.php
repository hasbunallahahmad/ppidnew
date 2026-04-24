<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSetiapSaatSeeder extends Seeder
{
    /**
     * Jalankan: php artisan db:seed --class=InformasiSetiapSaatSeeder
     */
    public function run(): void
    {
        $structured = [
            'rows' => [
                // No 1 — dengan sub-kategori
                [
                    'no'    => 1,
                    'jenis' => 'Informasi tentang organisasi, administrasi, kepegawaian, dan keuangan',
                    'sub'   => [
                        [
                            'rincian' => 'Informasi Terkait Organisasi',
                            'items'   => [
                                ['label' => 'Struktur Organisasi', 'url' => '/page/struktur-organisasi'],
                                ['label' => 'Tugas dan Fungsi dari masing-masing unit organisasi', 'url' => '#'],
                                ['label' => 'Alamat dan Kontak: Alamat lengkap OPD, nomor telepon, email, dan situs web resmi', 'url' => '#'],
                                ['label' => 'Profil Pimpinan: Nama, jabatan, dan riwayat jabatan resmi', 'url' => '#'],
                                ['label' => 'Daftar Pegawai', 'url' => '#'],
                            ],
                        ],
                        [
                            'rincian' => 'Informasi Terkait Administrasi',
                            'items'   => [
                                ['label' => 'Dasar Hukum (Peraturan): Daftar peraturan perundang-undangan', 'url' => '#'],
                                ['label' => 'Standar Operasional Prosedur (SOP)', 'url' => '#'],
                                ['label' => 'Rancangan Peraturan atau Kebijakan', 'url' => '#'],
                                ['label' => 'Mekanisme Pengaduan: Prosedur resmi bagi masyarakat', 'url' => '#'],
                            ],
                        ],
                        [
                            'rincian' => 'Informasi Terkait Kepegawaian',
                            'items'   => [
                                ['label' => 'Profil Umum Kepegawaian: Data statistik jumlah total pegawai', 'url' => '#'],
                                ['label' => 'Prosedur dan Syarat Rekrutmen', 'url' => '#'],
                                ['label' => 'Sistem dan Jenjang Karir', 'url' => '#'],
                            ],
                        ],
                        [
                            'rincian' => 'Informasi Terkait Keuangan',
                            'items'   => [
                                ['label' => 'Ringkasan Rencana dan Dokumen Pelaksanaan Anggaran (DPA/DIPA)', 'url' => '#'],
                                ['label' => 'Ringkasan Laporan Realisasi Anggaran (LRA)', 'url' => '#'],
                                ['label' => 'Neraca Keuangan: Laporan posisi keuangan', 'url' => '#'],
                                ['label' => 'Rencana Umum Pengadaan (RUP) Barang dan Jasa', 'url' => 'https://sirup.lkpp.go.id'],
                                ['label' => 'Daftar Aset: Informasi mengenai daftar aset atau inventaris', 'url' => '#'],
                            ],
                        ],
                    ],
                ],

                // No 2 — tanpa sub
                [
                    'no'    => 2,
                    'jenis' => 'Surat-surat perjanjian dengan pihak ketiga berikut dokumen pendukungnya',
                    'sub'   => [],
                    'items' => [
                        ['label' => 'Perjanjian kerjasama', 'url' => '#'],
                        ['label' => 'Perjanjian Sewa-Menyewa', 'url' => '#'],
                        ['label' => 'Perjanjian Pemanfaatan Aset Daerah', 'url' => '#'],
                    ],
                ],

                // No 3
                [
                    'no'    => 3,
                    'jenis' => 'Surat menyurat pimpinan atau Badan Publik dalam rangka pelaksanaan tugas, fungsi, dan wewenang',
                    'sub'   => [],
                    'items' => [
                        ['label' => 'Surat masuk', 'url' => '#'],
                        ['label' => 'Surat keluar', 'url' => '#'],
                    ],
                ],

                // No 4
                [
                    'no'    => 4,
                    'jenis' => 'Persyaratan perizinan, izin yang diterbitkan dan/atau dikeluarkan berikut dokumen pendukungnya',
                    'sub'   => [],
                    'items' => [
                        ['label' => 'Persyaratan Perizinan Peminjaman Arsip', 'url' => '#'],
                    ],
                ],

                // No 5
                [
                    'no'    => 5,
                    'jenis' => 'Data perbendaharaan atau inventaris',
                    'sub'   => [],
                    'keterangan' => '<p><strong>Data Perbendaharaan (Keuangan):</strong></p>
<ul class="iss-list">
<li><a href="#">Dokumen Pelaksanaan Anggaran (DPA)</a></li>
<li><a href="#">Laporan Realisasi Anggaran (LRA)</a></li>
<li><a href="#">Register Surat Perintah Pencairan Dana (SP2D)</a></li>
</ul>
<p><strong>Data Inventaris (Aset/Barang Milik Daerah):</strong></p>
<ul class="iss-list">
<li><a href="#">Daftar Aset Tetap Secara Umum</a></li>
</ul>',
                ],

                // No 6
                [
                    'no'    => 6,
                    'jenis' => 'Rencana strategis dan rencana kerja Badan Publik',
                    'sub'   => [
                        [
                            'rincian' => 'Rencana strategis dan rencana kerja Dinas Arsip dan Perpustakaan Kota Semarang',
                            'items'   => [
                                ['label' => 'Rencana Strategis (Renstra)', 'url' => '#'],
                                ['label' => 'Rencana Kerja (Renja)', 'url' => '#'],
                            ],
                        ],
                    ],
                ],

                // No 7
                [
                    'no'    => 7,
                    'jenis' => 'Agenda kerja pimpinan satuan kerja',
                    'sub'   => [
                        [
                            'rincian'    => 'Agenda Dinas Arsip dan Perpustakaan Kota Semarang',
                            'keterangan' => 'Selengkapnya Klik <a href="#" target="_blank">DISINI</a>',
                            'items'      => [],
                        ],
                    ],
                ],

                // No 8
                [
                    'no'    => 8,
                    'jenis' => 'Informasi mengenai kegiatan pelayanan Informasi Publik',
                    'sub'   => [],
                    'items' => [
                        ['label' => 'Laporan Pelayanan Informasi yang Dilakukan', 'url' => '#'],
                        ['label' => 'Standar Pelayanan Publik', 'url' => '#'],
                    ],
                ],

                // No 9
                [
                    'no'    => 9,
                    'jenis' => 'Daftar serta hasil-hasil penelitian yang dilakukan',
                    'sub'   => [],
                    'keterangan' => 'Selengkapnya klik <a href="#" target="_blank">DISINI</a>',
                ],

                // No 10
                [
                    'no'    => 10,
                    'jenis' => 'Informasi tentang standar pengumuman Informasi',
                    'sub'   => [],
                    'keterangan' => 'Selengkapnya klik <a href="#" target="_blank">DISINI</a>',
                ],
            ],
        ];

        // Cari page dengan slug informasi-setiap-saat
        $page = DB::table('pages')->where('slug', 'informasi-setiap-saat')->first();

        if ($page) {
            DB::table('pages')
                ->where('slug', 'informasi-setiap-saat')
                ->update([
                    'structured_content' => json_encode($structured),
                    'updated_at'         => now(),
                ]);
            $this->command->info('✅ structured_content berhasil diisi untuk halaman Informasi Setiap Saat');
        } else {
            $this->command->warn('⚠️  Halaman dengan slug "informasi-setiap-saat" tidak ditemukan di tabel pages.');
        }
    }
}
