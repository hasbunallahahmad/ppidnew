<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSertaMertaSeeder extends Seeder
{
    public function run(): void
    {
        $structured = [
            'intro' => 'Informasi Serta Merta adalah informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum yang harus segera diumumkan oleh Badan Publik tanpa menunggu permintaan.',
            'sections' => [
                [
                    'title' => 'Informasi Layanan Darurat Perpustakaan',
                    'items' => [
                        ['label' => 'Status Layanan Perpustakaan Real-Time', 'url' => '#'],
                        ['label' => 'Informasi Penutupan Darurat Perpustakaan', 'url' => '#'],
                        ['label' => 'Gangguan Sistem Perpustakaan Digital', 'url' => '#'],
                        ['label' => 'Jadwal Pemeliharaan Sistem Darurat', 'url' => '#'],
                    ],
                ],
                [
                    'title' => 'Informasi Keamanan Koleksi dan Arsip',
                    'items' => [
                        ['label' => 'Status Keamanan Ruang Penyimpanan Arsip', 'url' => '#'],
                        ['label' => 'Gangguan Sistem Klimatologi Arsip', 'url' => '#'],
                        ['label' => 'Kondisi Preservasi Koleksi Bersejarah', 'url' => '#'],
                        ['label' => 'Backup Data Arsip Elektronik', 'url' => '#'],
                    ],
                ],
                [
                    'title' => 'Informasi Gangguan Utilitas',
                    'items' => [
                        ['label' => 'Gangguan Listrik yang Mempengaruhi Layanan', 'url' => '#'],
                        ['label' => 'Gangguan Internet/Jaringan', 'url' => '#'],
                        ['label' => 'Gangguan Air Bersih di Fasilitas Dinas', 'url' => '#'],
                        ['label' => 'Gangguan Sistem Keamanan Gedung', 'url' => '#'],
                    ],
                ],
                [
                    'title' => 'Informasi Kesehatan Darurat',
                    'items' => [
                        ['label' => 'Protokol COVID-19 di Perpustakaan', 'url' => '#'],
                        ['label' => 'Informasi Wabah Penyakit Menular', 'url' => '#'],
                        ['label' => 'Peringatan Kontaminasi Makanan/Minuman', 'url' => '#'],
                        ['label' => 'Kualitas Udara dan Kesehatan Pengunjung', 'url' => '#'],
                    ],
                ],
            ],
        ];

        $page = DB::table('pages')->where('slug', 'informasi-serta-merta')->first();

        if ($page) {
            DB::table('pages')
                ->where('slug', 'informasi-serta-merta')
                ->update([
                    'structured_content' => json_encode($structured),
                    'updated_at'         => now(),
                ]);
            $this->command->info('✅ structured_content berhasil diisi untuk halaman Informasi Serta Merta');
        } else {
            $this->command->warn('⚠️ Halaman dengan slug "informasi-serta-merta" tidak ditemukan.');
        }
    }
}
