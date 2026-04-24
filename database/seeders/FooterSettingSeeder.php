<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaultFooter = [
            'slug' => 'footer-utama',
            'brand_name' => 'Dinas Arsip & Perpustakaan Kota Semarang',
            'tagline' => 'Melayani keterbukaan informasi publik di bidang kearsipan dan perpustakaan secara profesional dan akuntabel.',
            'social_facebook' => 'https://facebook.com/dinarpus.semarang',
            'social_twitter' => 'https://twitter.com/dinarpus_smg',
            'social_instagram' => 'https://instagram.com/dinarpus_semarang',
            'social_youtube' => 'https://youtube.com/c/DinarpusSemarang',
            'cert_1_text' => 'ISO 9001:2015',
            'cert_1_icon' => 'heroicon-o-star',
            'cert_2_text' => 'ISO 27001:2013',
            'cert_2_icon' => 'heroicon-o-shield-check',
            'contact_address' => 'Jl. Pemuda No.148, Kota Semarang, Jawa Tengah 50132',
            'contact_phone' => '(024) 3515151',
            'contact_email' => 'ppid.dinarpus@semarangkota.go.id',
            'contact_fax' => '(024) 3540300',
            'contact_hours' => 'Senin – Jumat: 08:00 – 16:00 WIB
Sabtu: 08:00 – 12:00 WIB
Minggu & Hari Libur: Tutup',
            'section_1_menu' => json_encode([
                ['label' => 'Asensus Arsip', 'url' => '/layanan/asensus-arsip'],
                ['label' => 'Invenaris Arsip', 'url' => '/layanan/invenaris-arsip'],
                ['label' => 'Pemeliharaan Arsip', 'url' => '/layanan/pemeliharaan-arsip'],
                ['label' => 'Reproduksi Arsip', 'url' => '/layanan/reproduksi-arsip'],
            ]),
            'section_2_menu' => json_encode([
                ['label' => 'Koleksi Buku', 'url' => '/layanan/koleksi-buku'],
                ['label' => 'Peminjaman', 'url' => '/layanan/peminjaman'],
                ['label' => 'Referensi', 'url' => '/layanan/referensi'],
                ['label' => 'Program Literasi', 'url' => '/layanan/program-literasi'],
            ]),
            'section_3_menu' => json_encode([
                ['label' => 'Tentang Kami', 'url' => '/tentang'],
                ['label' => 'Daftar Informasi Publik', 'url' => '/informasi'],
                ['label' => 'Berita & Artikel', 'url' => '/berita'],
                ['label' => 'Hubungi Kami', 'url' => '/kontak'],
            ]),
            'footer_copyright' => '© 2024 Dinas Arsip & Perpustakaan Kota Semarang. Semua hak dilindungi undang-undang.',
        ];

        // createOrFirst agar idempotent - tidak membuat duplikat jika dijalankan ulang
        FooterSetting::createOrFirst(
            ['id' => 1],
            $defaultFooter
        );
    }
}
