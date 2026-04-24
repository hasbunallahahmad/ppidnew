<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaftarInformasiBerkalaSeeder extends Seeder
{
    /**
     * Update konten halaman "Informasi Berkala" (id = 6)
     * pada tabel pages yang sudah ada.
     *
     * Jalankan: php artisan db:seed --class=InformasiBerkalaSeeder
     */
    public function run(): void
    {
        $content = $this->buildContent();

        // Target langsung ke id = 6 (slug: informasi-berkala)
        DB::table('pages')
            ->where('id', 6)
            ->update([
                'content'    => $content,
                'updated_at' => now(),
            ]);

        $this->command->info('✅  Konten halaman Informasi Berkala (id=6) berhasil diperbarui.');
    }

    // ================================================================
    //  DATA
    //  Ganti 'url' => '#' dengan path/URL dokumen yang sebenarnya
    //  misal: '/storage/dokumen/lkj-2024.pdf'
    // ================================================================
    private function getData(): array
    {
        return [

            // 1 -------------------------------------------------------
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

            // 2 -------------------------------------------------------
            [
                'kategori' => 'Ringkasan laporan keuangan yang telah diaudit',
                'items' => [
                    ['jenis' => 'Rencana dan laporan realisasi anggaran', 'url' => '#'],
                    ['jenis' => 'Neraca', 'url' => '#'],
                    ['jenis' => 'Laporan arus kas dan catatan atas laporan keuangan (CALK)', 'url' => '#'],
                    ['jenis' => 'Daftar aset dan investasi', 'url' => '#'],
                ],
            ],

            // 3 -------------------------------------------------------
            [
                'kategori' => 'Laporan Kinerja Instansi Pemerintah (LKjIP)',
                'items' => [
                    ['jenis' => 'Laporan Kinerja (LKj) Tahun 2024', 'url' => '#'],
                    ['jenis' => 'Laporan Kinerja (LKj) Tahun 2023', 'url' => '#'],
                    ['jenis' => 'Perjanjian Kinerja (PK) Tahun 2025', 'url' => '#'],
                    ['jenis' => 'Indikator Kinerja Utama (IKU)', 'url' => '#'],
                ],
            ],

            // 4 -------------------------------------------------------
            [
                'kategori' => 'Laporan layanan informasi publik (wajib diumumkan 1 kali setahun)',
                'items' => [
                    ['jenis' => 'Jumlah permohonan informasi yang diterima', 'url' => '#'],
                    ['jenis' => 'Waktu yang diperlukan dalam memenuhi setiap permohonan informasi', 'url' => '#'],
                    ['jenis' => 'Jumlah permohonan informasi yang dikabulkan dan ditolak', 'url' => '#'],
                    ['jenis' => 'Alasan penolakan permohonan informasi', 'url' => '#'],
                ],
            ],

            // 5 -------------------------------------------------------
            [
                'kategori' => 'Peraturan, keputusan, dan/atau kebijakan yang mengikat publik',
                'items' => [
                    ['jenis' => 'Peraturan Daerah (Perda) terkait kearsipan dan perpustakaan', 'url' => '#'],
                    ['jenis' => 'Peraturan Walikota (Perwali) terkait Dinas', 'url' => '#'],
                    ['jenis' => 'Keputusan Kepala Dinas', 'url' => '#'],
                    ['jenis' => 'Standar Operasional Prosedur (SOP)', 'url' => '#'],
                ],
            ],

            // 6 -------------------------------------------------------
            [
                'kategori' => 'Informasi pengadaan barang dan jasa',
                'items' => [
                    ['jenis' => 'Rencana Umum Pengadaan (RUP) Tahun 2025', 'url' => 'https://sirup.lkpp.go.id'],
                    ['jenis' => 'Pengumuman tender / seleksi', 'url' => 'https://lpse.semarangkota.go.id'],
                    ['jenis' => 'Hasil pengadaan barang/jasa', 'url' => '#'],
                ],
            ],

            // 7 -------------------------------------------------------
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
        ];
    }

    // ================================================================
    //  BUILD FULL HTML
    // ================================================================
    private function buildContent(): string
    {
        $html = '';
        foreach ($this->getData() as $section) {
            $html .= $this->buildSection($section['kategori'], $section['items']);
        }
        return $html;
    }

    // ================================================================
    //  BUILD 1 SECTION
    // ================================================================
    private function buildSection(string $kategori, array $items): string
    {
        $header = '<p class="ppid-section-header">' . e($kategori) . '</p>';

        $thRow = '<tr>'
            . '<th rowspan="1" colspan="1" style="width:80%;"><p>Jenis Informasi</p></th>'
            . '<th rowspan="1" colspan="1" style="width:20%; text-align:center;"><p>Link Alternatif</p></th>'
            . '</tr>';

        $rows = '';
        foreach ($items as $item) {
            $isExternal = str_starts_with($item['url'], 'http');
            $target     = $isExternal ? ' target="_blank" rel="noopener noreferrer"' : '';
            $btnClass   = $item['url'] === '#'
                ? 'ppid-btn-link ppid-btn-disabled'
                : 'ppid-btn-link';

            $btn = '<a href="' . e($item['url']) . '"'
                . $target
                . ' class="' . $btnClass . '">Klik Disini</a>';

            $rows .= '<tr>'
                . '<td rowspan="1" colspan="1" style="width:80%; vertical-align:middle;"><p>' . e($item['jenis']) . '</p></td>'
                . '<td rowspan="1" colspan="1" style="width:20%; text-align:right; vertical-align:middle;"><p>' . $btn . '</p></td>'
                . '</tr>';
        }

        return $header
            . '<table style="width:100%; table-layout:fixed;"><tbody>' . $thRow . $rows . '</tbody></table>';
    }
}
