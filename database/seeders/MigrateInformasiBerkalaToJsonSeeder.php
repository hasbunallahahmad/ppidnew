<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateInformasiBerkalaToJsonSeeder extends Seeder
{
    public function run(): void
    {
        $structured = [
            'sections' => [
                [
                    'kategori' => 'Informasi tentang program dan / atau kegiatan yang sedang dijalankan dalam lingkup badan publik',
                    'items' => [
                        ['jenis' => 'Nama program dan kegiatan', 'url' => '#'],
                        ['jenis' => 'Penanggungjawab, pelaksana program dan kegiatan serta nomor telepon dan/atau alamat yang dapat dihubungi', 'url' => '#'],
                        ['jenis' => 'Target dan/atau capaian program dan kegiatan', 'url' => '#'],
                        ['jenis' => 'Jadwal pelaksanaan program dan kegiatan', 'url' => '#'],
                        ['jenis' => 'Anggaran program dan kegiatan yang meliputi sumber dan jumlah', 'url' => '#'],
                        ['jenis' => 'Agenda penting terkait pelaksanaan tugas Badan Publik', 'url' => '#'],
                        ['jenis' => 'Informasi khusus lainnya yang berkaitan langsung dengan hak-hak masyarakat', 'url' => '#'],
                        ['jenis' => 'Informasi tentang penerimaan calon pegawai dan/atau pejabat Badan Publik Negara', 'url' => '#'],
                        ['jenis' => 'Informasi tentang penerimaan calon peserta didik pada Badan Publik yang menyelenggarakan kegiatan pendidikan untuk umum.', 'url' => '#'],
                        ['jenis' => 'Mengumumkan KAK 2025', 'url' => '#'],
                        ['jenis' => 'Agenda penting terkait pelaksanaan tugas Badan Publik (Surat)', 'url' => '#'],
                    ],
                ],
                [
                    'kategori' => 'Ringkasan laporan keuangan yang telah diaudit',
                    'items' => [
                        ['jenis' => 'Rencana dan laporan realisasi anggaran', 'url' => '#'],
                        ['jenis' => 'Neraca', 'url' => '#'],
                        ['jenis' => 'Laporan arus kas dan catatan atas laporan keuangan (CALK)', 'url' => '#'],
                        ['jenis' => 'Daftar aset dan investasi', 'url' => '#'],
                    ],
                ],
                [
                    'kategori' => 'Laporan Kinerja Instansi Pemerintah (LKjIP)',
                    'items' => [
                        ['jenis' => 'Laporan Kinerja (LKj) Tahun 2024', 'url' => '#'],
                        ['jenis' => 'Laporan Kinerja (LKj) Tahun 2023', 'url' => '#'],
                        ['jenis' => 'Perjanjian Kinerja (PK) Tahun 2025', 'url' => '#'],
                        ['jenis' => 'Indikator Kinerja Utama (IKU)', 'url' => '#'],
                    ],
                ],
                [
                    'kategori' => 'Laporan layanan informasi publik (wajib diumumkan 1 kali setahun)',
                    'items' => [
                        ['jenis' => 'Jumlah permohonan informasi yang diterima', 'url' => '#'],
                        ['jenis' => 'Waktu yang diperlukan dalam memenuhi setiap permohonan informasi', 'url' => '#'],
                        ['jenis' => 'Jumlah permohonan informasi yang dikabulkan dan ditolak', 'url' => '#'],
                        ['jenis' => 'Alasan penolakan permohonan informasi', 'url' => '#'],
                    ],
                ],
                [
                    'kategori' => 'Peraturan, keputusan, dan/atau kebijakan yang mengikat publik',
                    'items' => [
                        ['jenis' => 'Peraturan Daerah (Perda) terkait kearsipan dan perpustakaan', 'url' => '#'],
                        ['jenis' => 'Peraturan Walikota (Perwali) terkait Dinas', 'url' => '#'],
                        ['jenis' => 'Keputusan Kepala Dinas', 'url' => '#'],
                        ['jenis' => 'Standar Operasional Prosedur (SOP)', 'url' => '#'],
                    ],
                ],
                [
                    'kategori' => 'Informasi pengadaan barang dan jasa',
                    'items' => [
                        ['jenis' => 'Rencana Umum Pengadaan (RUP) Tahun 2025', 'url' => 'https://sirup.lkpp.go.id'],
                        ['jenis' => 'Pengumuman tender / seleksi', 'url' => 'https://lpse.semarangkota.go.id'],
                        ['jenis' => 'Hasil pengadaan barang/jasa', 'url' => '#'],
                    ],
                ],
                [
                    'kategori' => 'Informasi profil dan gambaran umum Badan Publik',
                    'items' => [
                        ['jenis' => 'Visi dan Misi', 'url' => '/pages/visi-misi'],
                        ['jenis' => 'Tugas Pokok dan Fungsi (Tupoksi)', 'url' => '/pages/tupoksi'],
                        ['jenis' => 'Struktur Organisasi', 'url' => '/pages/struktur-organisasi'],
                        ['jenis' => 'Profil Pejabat', 'url' => '/pages/profil-pejabat'],
                        ['jenis' => 'Alamat, telepon, fax, dan email resmi', 'url' => '/pages/kontak'],
                    ],
                ],
            ],
        ];

        DB::table('pages')
            ->where('id', 6)
            ->update([
                'structured_content' => json_encode($structured),
                'updated_at'         => now(),
            ]);

        $this->command->info('✅ structured_content berhasil diisi untuk halaman Informasi Berkala (id=6)');
    }
}
