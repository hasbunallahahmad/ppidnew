<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing pages
        Page::truncate();

        $pages = [
            [
                'slug' => 'tentang-dinas',
                'title' => 'Tentang Dinas Arsip & Perpustakaan',
                'description' => 'Informasi lengkap tentang Dinas Arsip & Perpustakaan Kota Semarang',
                'content' => '<h3>Sejarah Singkat</h3>
<p>Dinas Arsip dan Perpustakaan didirikan dengan tujuan untuk melestarikan arsip-arsip berharga dan memberikan akses informasi kepada masyarakat luas. Institusi ini terus berinovasi untuk memberikan layanan terbaik.</p>
<h3>Visi</h3>
<p>Menjadi lembaga pengelola arsip dan perpustakaan yang modern, profesional, dan terpercaya dalam melayani masyarakat.</p>
<h3>Misi</h3>
<ul>
<li>Melakukan pengelolaan arsip dengan standar internasional</li>
<li>Memberikan akses informasi yang mudah dan terjangkau</li>
<li>Mengembangkan koleksi berkualitas tinggi</li>
<li>Meningkatkan kesadaran masyarakat tentang pentingnya arsip dan informasi</li>
</ul>',
            ],
            [
                'slug' => 'struktur-organisasi',
                'title' => 'Struktur Organisasi',
                'description' => 'Struktur organisasi Dinas Arsip & Perpustakaan Kota Semarang',
                'content' => '<p>Dinas Arsip dan Perpustakaan Kota Semarang memiliki struktur organisasi yang terorganisir dengan baik untuk melayani masyarakat secara optimal.</p>
<h3>Susunan Organisasi</h3>
<ul>
<li>Kepala Dinas</li>
<li>Sekretariat</li>
<li>Bidang Pengelolaan Arsip</li>
<li>Bidang Perpustakaan</li>
<li>Bidang Pengembangan dan Inovasi</li>
</ul>',
                'pdf_file' => 'pages-pdf/01KNP328XQGARQZQSPWWWA9PP3.pdf',
            ],
            [
                'slug' => 'visi-misi',
                'title' => 'Visi & Misi',
                'description' => 'Visi dan misi Dinas Arsip & Perpustakaan Kota Semarang',
                'content' => '<h3>Visi</h3>
<p>Menjadi lembaga pengelola informasi dan dokumentasi yang modern, transparan, dan responsif terhadap kebutuhan masyarakat.</p>
<h3>Misi</h3>
<ol>
<li>Menyelenggarakan pengelolaan arsip dan dokumentasi dengan standar yang baik</li>
<li>Menyediakan layanan informasi yang mudah diakses oleh masyarakat</li>
<li>Meningkatkan kualitas koleksi perpustakaan</li>
<li>Memberikan pelayanan prima kepada semua pengguna</li>
<li>Mendukung terwujudnya keterbukaan informasi publik</li>
</ol>',
            ],
            [
                'slug' => 'dasar-hukum',
                'title' => 'Dasar Hukum',
                'description' => 'Dasar hukum yang menjadi landasan penyelenggaraan PPID',
                'content' => '<h3>Peraturan dan Undang-Undang</h3>
<ul>
<li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
<li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008</li>
<li>Peraturan Kepala Arsip Nasional Republik Indonesia Nomor 14 Tahun 2015</li>
<li>Peraturan Daerah Kota Semarang Tentang Arsip dan Perpustakaan</li>
</ul>
<p>Semua kegiatan pelaksanaan PPID didasarkan pada peraturan-peraturan di atas dan komitmen untuk transparansi.</p>',
            ],
            [
                'slug' => 'profil-ppid',
                'title' => 'Profil PPID',
                'description' => 'Profil dan informasi tentang Pejabat Pengelola Informasi dan Dokumentasi (PPID)',
                'content' => '<h3>Tentang PPID</h3>
<p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah pejabat yang bertanggung jawab di bidang informasi dan dokumentasi pada badan publik.</p>
<h3>Fungsi PPID</h3>
<ul>
<li>Menerima, mencatat, dan mendistribusikan permohonan informasi</li>
<li>Memberikan informasi sesuai dengan kewenangan</li>
<li>Penolakan Informasi (kalau ada alasan sesuai UU)</li>
<li>Penyelesaian sengketa informasi</li>
</ul>
<h3>Kontak PPID</h3>
<p>Untuk pertanyaan mengenai informasi publik dan pelayanan PPID, silakan hubungi kami.</p>',
            ],
            [
                'slug' => 'informasi-berkala',
                'title' => 'Informasi Berkala',
                'description' => 'Informasi berkala yang dipublikasikan secara teratur',
                'content' => '<h3>Jenis Informasi Berkala</h3>
<p>Informasi berkala adalah informasi yang secara rutin diterbitkan oleh badan publik sesuai dengan fungsi dan tugasnya.</p>
<h3>Informasi yang Kami Publikasikan</h3>
<ul>
<li>Laporan Kinerja Dinas</li>
<li>Statistik Pengunjung</li>
<li>Data Koleksi Perpustakaan</li>
<li>Laporan Pengelolaan Arsip</li>
<li>Berita dan Pengumuman Resmi</li>
</ul>
<p>Informasi ini dapat diakses melalui website kami atau dengan menghubungi langsung PPID.</p>',
            ],
            [
                'slug' => 'informasi-setiap-saat',
                'title' => 'Informasi Setiap Saat',
                'description' => 'Informasi setiap saat yang dapat diakses kapan saja',
                'content' => '<h3>Informasi Setiap Saat</h3>
<p>Informasi setiap saat adalah informasi yang dapat diminta dan harus disediakan setiap saat tanpa menunggu waktu pertanyaan yang dijadwalkan.</p>
<h3>Contoh Informasi Setiap Saat</h3>
<ul>
<li>Visi, Misi, dan Tujuan Dinas</li>
<li>Program Kerja dan Rencana Strategis</li>
<li>Struktur Organisasi dan Tata Kerja</li>
<li>Peraturan dan Kebijakan Internal</li>
<li>Lokasi dan Jam Operasional</li>
<li>Daftar Pegawai dan Sarana Layanan</li>
</ul>
<p>Informasi ini tersedia melalui berbagai saluran komunikasi kami.</p>',
            ],
            [
                'slug' => 'informasi-serta-merta',
                'title' => 'Informasi Serta Merta',
                'description' => 'Informasi serta merta yang penting untuk publik',
                'content' => '<h3>Informasi Serta Merta</h3>
<p>Informasi serta merta adalah informasi yang harus segera diumumkan kepada masyarakat karena menyangkut kepentingan publik yang luas dan dampak sosial yang besar.</p>
<h3>Kriteria Informasi Serta Merta</h3>
<ul>
<li>Menyangkut ancaman keselamatan dan kesehatan masyarakat</li>
<li>Memiliki dampak sosial yang luas</li>
<li>Memerlukan tindakan cepat dari masyarakat</li>
<li>Berkaitan dengan musibah atau bencana</li>
</ul>
<p>Informasi serta merta kami sampaikan melalui media massa dan saluran komunikasi yang tersedia.</p>',
            ],
            [
                'slug' => 'informasi-dikecualikan',
                'title' => 'Informasi Dikecualikan',
                'description' => 'Informasi yang dikecualikan dari akses publik',
                'content' => '<h3>Informasi Dikecualikan</h3>
<p>Berdasarkan Undang-Undang Keterbukaan Informasi Publik, terdapat beberapa jenis informasi yang dikecualikan dari akses publik.</p>
<h3>Jenis Informasi yang Dikecualikan</h3>
<ul>
<li>Rahasia negara sebagaimana diatur dalam peraturan perundang-undangan</li>
<li>Privasi pribadi orang lain</li>
<li>Kepentingan bisnis badan publik</li>
<li>Rahasia jabatan</li>
<li>Informasi yang dapat menganggu proses penegakan hukum</li>
<li>Informasi lainnya sesuai dengan ketentuan peraturan perundang-undangan</li>
</ul>
<p>Untuk informasi lebih lanjut mengenai pengecualian informasi, silakan hubungi PPID kami.</p>',
            ],
            [
                'slug' => 'statistik-layanan',
                'title' => 'Statistik Layanan',
                'description' => 'Statistik dan data layanan PPID',
                'content' => '<h3>Statistik Layanan PPID</h3>
<p>Berikut adalah statistik layanan PPID dalam melayani masyarakat yang meminta informasi publik.</p>
<h3>Data Layanan</h3>
<ul>
<li>Total Permohonan Informasi: Diupdate setiap bulan</li>
<li>Permohonan yang Dikabulkan: Data terakhir tersedia</li>
<li>Permohonan yang Ditolak: Dengan alasan yang jelas</li>
<li>Waktu Respons Rata-rata: Dalam batas yang ditentukan</li>
<li>Kepuasan Pemberi Informasi: Diukur secara berkala</li>
</ul>
<p>Statistik lengkap dapat diakses melalui laporan tahunan PPID kami.</p>',
            ],
            [
                'slug' => 'arsip-digital',
                'title' => 'Arsip Digital',
                'description' => 'Layanan Arsip Digital Dinas Arsip & Perpustakaan',
                'content' => '<h3>Layanan Arsip Digital</h3>
<p>Dinas Arsip & Perpustakaan menyediakan layanan digitalisasi arsip untuk memudahkan akses dan pelestarian dokumen penting.</p>
<h3>Manfaat Arsip Digital</h3>
<ul>
<li>Mudah diakses dari mana saja</li>
<li>Terjamin keamanan dan keaslian</li>
<li>Mengurangi ruang penyimpanan fisik</li>
<li>Memperpanjang usia dokumen</li>
<li>Dapat dicari dengan mudah</li>
</ul>
<h3>Proses Digitalisasi</h3>
<p>Kami telah mendigitalkan ribuan dokumen penting dengan standar internasional dan terus menambahkan koleksi digital kami.</p>',
            ],
            [
                'slug' => 'akuisisi-arsip',
                'title' => 'Akuisisi Arsip',
                'description' => 'Program akuisisi arsip dari berbagai institusi',
                'content' => '<h3>Program Akuisisi Arsip</h3>
<p>Program akuisisi arsip bertujuan untuk mengumpulkan, melestarikan, dan memberikan akses ke dokumen-dokumen penting dari berbagai institusi.</p>
<h3>Jenis Akuisisi</h3>
<ul>
<li>Akuisisi dari institusi pemerintah</li>
<li>Akuisisi dari organisasi non-pemerintah</li>
<li>Akuisisi dari donasi pribadi</li>
<li>Akuisisi dari koleksi masyarakat</li>
</ul>
<h3>Tujuan Akuisisi</h3>
<p>Tujuan dari program akuisisi adalah membangun koleksi arsip yang komprehensif dan representatif untuk sejarah dan warisan budaya.</p>',
            ],
            [
                'slug' => 'restorasi',
                'title' => 'Restorasi & Konservasi',
                'description' => 'Layanan restorasi dan konservasi dokumen arsip',
                'content' => '<h3>Layanan Restorasi & Konservasi</h3>
<p>Dinas Arsip & Perpustakaan menyediakan layanan profesional untuk restorasi dan konservasi dokumen arsip yang rusak atau langka.</p>
<h3>Jenis Layanan</h3>
<ul>
<li>Pembersihan dokumen</li>
<li>Perbaikan kertas rusak</li>
<li>Penjilidan ulang</li>
<li>Fumigasi dan perawatan</li>
<li>Stabilisasi dokumen langka</li>
</ul>
<h3>Biaya Layanan</h3>
<p>Biaya restorasi ditentukan berdasarkan jenis dan tingkat kerusakan dokumen. Silakan hubungi kami untuk konsultasi gratis.</p>',
            ],
            [
                'slug' => 'depo-arsip',
                'title' => 'Depo Arsip Daerah',
                'description' => 'Depo penyimpanan arsip daerah Kota Semarang',
                'content' => '<h3>Depo Arsip Daerah</h3>
<p>Depo Arsip Daerah adalah fasilitas penyimpanan aksip modern yang dikelola oleh Dinas Arsip & Perpustakaan untuk menjaga kelestarian arsip.</p>
<h3>Fasilitas Depo</h3>
<ul>
<li>Ruang penyimpanan berpendingin dengan kelembaban terkontrol</li>
<li>Sistem keamanan 24 jam</li>
<li>Akses terbatas dan terukur</li>
<li>Penempatan dokumen sesuai klasifikasi</li>
<li>Sistem peminjaman terkomputerisasi</li>
</ul>
<h3>Kapasitas</h3>
<p>Depo kami memiliki kapasitas untuk menyimpan jutaan lembar dokumen dengan kondisi optimal.</p>',
            ],
            [
                'slug' => 'bimbingan-teknis',
                'title' => 'Bimbingan Teknis',
                'description' => 'Program bimbingan teknis pengelolaan arsip',
                'content' => '<h3>Program Bimbingan Teknis</h3>
<p>Dinas Arsip & Perpustakaan secara aktif memberikan bimbingan teknis kepada institusi lain tentang pengelolaan arsip yang baik.</p>
<h3>Topik Bimbingan Teknis</h3>
<ul>
<li>Sistem klasifikasi arsip internasional</li>
<li>Digitalisasi dan arsip elektronik</li>
<li>Preservasi dan konservasi dokumen</li>
<li>Manajemen informasi dan dokumentasi</li>
<li>Implementasi UU Keterbukaan Informasi</li>
</ul>
<h3>Target Peserta</h3>
<p>Program ini ditujukan untuk pegawai institusi pemerintah, swasta, dan organisasi non-pemerintah.</p>',
            ],
            [
                'slug' => 'katalog-koleksi',
                'title' => 'Katalog Koleksi',
                'description' => 'Katalog lengkap koleksi perpustakaan',
                'content' => '<h3>Katalog Koleksi Perpustakaan</h3>
<p>Perpustakaan kami memiliki koleksi lengkap berupa buku, jurnal, majalah, dan media lainnya yang dapat dicari melalui katalog digital kami.</p>
<h3>Jenis Koleksi</h3>
<ul>
<li>Buku teks dan referensi: Ribuan judul</li>
<li>Jurnal ilmiah: Koleksi lokal dan internasional</li>
<li>Majalah dan surat kabar: Arsip lengkap</li>
<li>Media audiovisual: Video dan rekaman</li>
<li>Peta dan poster: Koleksi khusus</li>
</ul>
<h3>Pencarian Katalog</h3>
<p>Gunakan sistem pencarian katalog digital kami untuk menemukan koleksi yang Anda cari.</p>',
            ],
            [
                'slug' => 'e-library',
                'title' => 'E-Library & E-Book',
                'description' => 'Layanan E-Library dan E-Book perpustakaan digital',
                'content' => '<h3>Layanan E-Library & E-Book</h3>
<p>Perpustakaan Digital kami menyediakan akses ke ribuan judul e-book dan jurnal elektronik yang dapat diakses 24/7 dari mana saja.</p>
<h3>Keuntungan E-Library</h3>
<ul>
<li>Akses 24 jam tanpa batas waktu</li>
<li>Dapat diakses dari berbagai perangkat</li>
<li>Pencarian teks lengkap</li>
<li>Bookmark dan anotasi pribadi</li>
<li>Tidak perlu antri peminjaman</li>
</ul>
<h3>Koleksi E-Book</h3>
<p>Koleksi kami mencakup berbagai kategori mulai dari fiksi, referensi, pendidikan, hingga penelitian.</p>',
            ],
            [
                'slug' => 'taman-baca',
                'title' => 'Taman Baca Masyarakat',
                'description' => 'Program Taman Baca Masyarakat',
                'content' => '<h3>Program Taman Baca Masyarakat</h3>
<p>Taman Baca Masyarakat adalah program inovatif untuk membawa literasi ke berbagai kawasan di Kota Semarang.</p>
<h3>Lokasi Taman Baca</h3>
<ul>
<li>Taman-taman publik</li>
<li>Pusat komunitas masyarakat</li>
<li>Sekolah dan pesantren</li>
<li>Panti asuhan dan PAUD</li>
</ul>
<h3>Fasilitas</h3>
<p>Setiap Taman Baca dilengkapi dengan koleksi buku, meja baca, dan pengelola yang siap membantu pengunjung.</p>
<h3>Manfaat</h3>
<p>Program ini bertujuan meningkatkan minat baca masyarakat terutama anak-anak dan merata-ratakan akses terhadap pengetahuan.</p>',
            ],
            [
                'slug' => 'inklusi-sosial',
                'title' => 'Layanan Inklusi Sosial',
                'description' => 'Layanan inklusi sosial perpustakaan',
                'content' => '<h3>Layanan Inklusi Sosial</h3>
<p>Perpustakaan kami berkomitmen untuk memberikan akses layanan perpustakaan kepada semua lapisan masyarakat tanpa diskriminasi.</p>
<h3>Kelompok Layanan Inklusi</h3>
<ul>
<li>Penyandang Disabilitas: Akses ramah dan koleksi khusus</li>
<li>Lansia: Layanan khusus dan area nyaman</li>
<li>Anak-anak: Program edukatif dan interaktif</li>
<li>Masyarakat kurang mampu: Layanan gratis</li>
<li>Komunitas khusus: Program disesuaikan kebutuhan</li>
</ul>
<h3>Fasilitas Aksesibilitas</h3>
<p>Perpustakaan kami dilengkapi dengan ramp untuk pengguna kursi roda, toilet khusus, area parkir, dan staf terlatih untuk membantu.</p>',
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
