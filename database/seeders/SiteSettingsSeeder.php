<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // --- Group: hero ---
            ['key' => 'hero_title',          'value' => 'Arsip & Literasi',           'type' => 'text', 'group' => 'hero',     'label' => 'Hero: Judul Baris 1'],
            ['key' => 'hero_subtitle',       'value' => 'untuk Semarang',             'type' => 'text', 'group' => 'hero',     'label' => 'Hero: Judul Baris 2 (Accent)'],
            ['key' => 'hero_desc',           'value' => 'Portal informasi publik Dinas Arsip dan Perpustakaan Kota Semarang. Akses arsip digital, katalog perpustakaan, infografis, statistik layanan, dan dokumen resmi secara mudah, terbuka, dan akuntabel.', 'type' => 'text', 'group' => 'hero', 'label' => 'Hero: Deskripsi'],
            ['key' => 'hero_btn_primary',    'value' => 'Ajukan Permohonan',          'type' => 'text', 'group' => 'hero',     'label' => 'Hero: Label Tombol Utama'],
            ['key' => 'hero_btn_secondary',  'value' => 'Jelajahi Layanan',           'type' => 'text', 'group' => 'hero',     'label' => 'Hero: Label Tombol Sekunder'],
            ['key' => 'hero_arsip_digital',  'value' => '8.240',                      'type' => 'text', 'group' => 'hero',     'label' => 'Hero Stats: Jumlah Arsip Digital'],
            ['key' => 'hero_koleksi_buku',   'value' => '42.680',                     'type' => 'text', 'group' => 'hero',     'label' => 'Hero Stats: Jumlah Koleksi Buku'],
            ['key' => 'hero_kepuasan',       'value' => '97,8%',                      'type' => 'text', 'group' => 'hero',     'label' => 'Hero Stats: Tingkat Kepuasan'],

            // --- Group: statistik (stats counter section) ---
            ['key' => 'stat_informasi',      'value' => '12.480',                     'type' => 'text', 'group' => 'statistik', 'label' => 'Stats: Informasi Tersedia'],
            ['key' => 'stat_permohonan',     'value' => '3.256',                      'type' => 'text', 'group' => 'statistik', 'label' => 'Stats: Permohonan Masuk'],
            ['key' => 'stat_selesai',        'value' => '3.198',                      'type' => 'text', 'group' => 'statistik', 'label' => 'Stats: Permohonan Selesai'],
            ['key' => 'stat_opd',            'value' => '48',                         'type' => 'text', 'group' => 'statistik', 'label' => 'Stats: OPD Terdaftar'],
            ['key' => 'stat_kepuasan',       'value' => '98.2',                       'type' => 'text', 'group' => 'statistik', 'label' => 'Stats: Tingkat Kepuasan (%)'],
            ['key' => 'stat_respon',         'value' => '3.2',                        'type' => 'text', 'group' => 'statistik', 'label' => 'Stats: Rata-rata Hari Respon'],

            // --- Group: statistik_perpustakaan ---
            ['key' => 'statpus_total_kunjungan', 'value' => '50.140', 'type' => 'text', 'group' => 'statistik_perpustakaan', 'label' => 'StatPus: Total Kunjungan'],
            ['key' => 'statpus_koleksi_buku',    'value' => '42.680', 'type' => 'text', 'group' => 'statistik_perpustakaan', 'label' => 'StatPus: Koleksi Buku'],
            ['key' => 'statpus_arsip_digital',   'value' => '8.240',  'type' => 'text', 'group' => 'statistik_perpustakaan', 'label' => 'StatPus: Arsip Digital'],
            ['key' => 'statpus_periode_aktif',   'value' => 'semester_2_2024', 'type' => 'text', 'group' => 'statistik_perpustakaan', 'label' => 'StatPus: Kode Periode Aktif'],

            // --- Group: kontak ---
            ['key' => 'kontak_alamat',       'value' => 'Jl. Pemuda No.148, Kota Semarang, Jawa Tengah 50132', 'type' => 'text', 'group' => 'kontak', 'label' => 'Kontak: Alamat'],
            ['key' => 'kontak_telepon',      'value' => '(024) 3515151',              'type' => 'text', 'group' => 'kontak',   'label' => 'Kontak: Telepon'],
            ['key' => 'kontak_fax',          'value' => '(024) 3540300',              'type' => 'text', 'group' => 'kontak',   'label' => 'Kontak: Fax'],
            ['key' => 'kontak_email',        'value' => 'ppid.dinarpus@semarangkota.go.id', 'type' => 'text', 'group' => 'kontak', 'label' => 'Kontak: Email'],
            ['key' => 'kontak_jam_operasional', 'value' => 'Senin–Jumat, 08.00–16.00 WIB', 'type' => 'text', 'group' => 'kontak', 'label' => 'Kontak: Jam Operasional'],

            // --- Group: social_media ---
            ['key' => 'sosmed_facebook',     'value' => '#',                          'type' => 'text', 'group' => 'social_media', 'label' => 'Sosmed: URL Facebook'],
            ['key' => 'sosmed_instagram',    'value' => '#',                          'type' => 'text', 'group' => 'social_media', 'label' => 'Sosmed: URL Instagram'],
            ['key' => 'sosmed_youtube',      'value' => '#',                          'type' => 'text', 'group' => 'social_media', 'label' => 'Sosmed: URL YouTube'],
            ['key' => 'sosmed_twitter',      'value' => '#',                          'type' => 'text', 'group' => 'social_media', 'label' => 'Sosmed: URL Twitter/X'],

            // --- Group: dokumen_desc (deskripsi 4 card daftar informasi) ---
            ['key' => 'daftarinfo_berkala_desc',      'value' => 'Informasi yang wajib disediakan dan diumumkan secara berkala minimal 6 bulan sekali.',          'type' => 'text', 'group' => 'dokumen_desc', 'label' => 'Daftar Info: Deskripsi Berkala'],
            ['key' => 'daftarinfo_setiap_saat_desc',  'value' => 'Informasi yang harus tersedia setiap saat dan dapat diakses kapanpun oleh pemohon.',            'type' => 'text', 'group' => 'dokumen_desc', 'label' => 'Daftar Info: Deskripsi Setiap Saat'],
            ['key' => 'daftarinfo_serta_merta_desc',  'value' => 'Informasi yang mengancam hajat hidup orang banyak dan ketertiban umum.',                        'type' => 'text', 'group' => 'dokumen_desc', 'label' => 'Daftar Info: Deskripsi Serta Merta'],
            ['key' => 'daftarinfo_dikecualikan_desc', 'value' => 'Informasi yang dikecualikan sesuai peraturan perundang-undangan yang berlaku.',                 'type' => 'text', 'group' => 'dokumen_desc', 'label' => 'Daftar Info: Deskripsi Dikecualikan'],

            // --- Group: general ---
            ['key' => 'site_name',           'value' => 'PPID Dinarpus',              'type' => 'text', 'group' => 'general',  'label' => 'Situs: Nama'],
            ['key' => 'site_tagline',        'value' => 'Dinas Arsip & Perpustakaan Kota Semarang', 'type' => 'text', 'group' => 'general', 'label' => 'Situs: Tagline'],
            ['key' => 'site_description',    'value' => 'Portal Pejabat Pengelola Informasi dan Dokumentasi Dinas Arsip dan Perpustakaan Kota Semarang', 'type' => 'text', 'group' => 'general', 'label' => 'Situs: Meta Description'],
            ['key' => 'footer_tagline',      'value' => 'Melayani keterbukaan informasi publik di bidang kearsipan dan perpustakaan secara profesional dan akuntabel.', 'type' => 'text', 'group' => 'general', 'label' => 'Footer: Tagline'],
            ['key' => 'cta_permohonan_title', 'value' => 'Tidak menemukan informasi yang Anda cari?', 'type' => 'text', 'group' => 'general', 'label' => 'CTA: Judul Permohonan'],
            ['key' => 'cta_permohonan_desc', 'value' => 'Ajukan permohonan informasi secara online. Kami akan merespons dalam waktu 10 hari kerja sesuai ketentuan UU KIP.', 'type' => 'text', 'group' => 'general', 'label' => 'CTA: Deskripsi Permohonan'],
        ];

        // insertOrIgnore agar seeder aman dijalankan ulang (idempotent)
        DB::table('site_settings')->insertOrIgnore(
            array_map(fn($s) => array_merge($s, [
                'created_at' => now(),
                'updated_at' => now(),
            ]), $settings)
        );
    }
}
