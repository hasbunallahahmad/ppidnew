<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Novius\LaravelFilamentNews\Models\NewsCategory;
use Novius\LaravelFilamentNews\Models\NewsPost;
use Novius\LaravelFilamentNews\Models\NewsTag;
use Novius\LaravelPublishable\Enums\PublicationStatus;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. CATEGORIES ─────────────────────────────────────
        $categories = [
            ['name' => 'Kearsipan',    'slug' => 'kearsipan'],
            ['name' => 'Perpustakaan', 'slug' => 'perpustakaan'],
            ['name' => 'Literasi',     'slug' => 'literasi'],
            ['name' => 'Prestasi',     'slug' => 'prestasi'],
            ['name' => 'Pengumuman',   'slug' => 'pengumuman'],
        ];

        $cat = [];
        foreach ($categories as $c) {
            $cat[$c['slug']] = NewsCategory::firstOrCreate(
                ['slug' => $c['slug'], 'locale' => 'id'],
                ['name' => $c['name']]
            );
        }

        // ── 2. TAGS ───────────────────────────────────────────
        $tags = [
            ['name' => 'Digitalisasi', 'slug' => 'digitalisasi'],
            ['name' => 'Arsip',        'slug' => 'arsip'],
            ['name' => 'PPID',         'slug' => 'ppid'],
            ['name' => 'Literasi',     'slug' => 'literasi'],
            ['name' => 'Semarang',     'slug' => 'semarang'],
            ['name' => 'Penghargaan',  'slug' => 'penghargaan'],
            ['name' => 'Keterbukaan',  'slug' => 'keterbukaan'],
            ['name' => 'Perpustakaan', 'slug' => 'perpustakaan'],
        ];

        $tag = [];
        foreach ($tags as $t) {
            $tag[$t['slug']] = NewsTag::firstOrCreate(
                ['slug' => $t['slug'], 'locale' => 'id'],
                ['name' => $t['name']]
            );
        }

        // ── 3. POSTS ──────────────────────────────────────────
        // Semua berita di bawah bersumber dari:
        // - arpusda.semarangkota.go.id (situs resmi Dinarpus Kota Semarang)
        // - arpusda.jatengprov.go.id (Dinarpus Provinsi Jawa Tengah)
        $posts = [

            // [1] Penghargaan Informatif II – 30 Sep 2025
            // Sumber: arpusda.semarangkota.go.id
            [
                'title'    => 'Dinas Arsip dan Perpustakaan Kota Semarang Raih Apresiasi Kategori Informatif II dengan Nilai 95,46',
                'slug'     => 'raih-apresiasi-informatif-ii-95-46',
                'locale'   => 'id',
                'featured' => true,
                'intro'    => 'Dinas Arsip dan Perpustakaan Kota Semarang meraih Apresiasi Kategori Informatif II dengan nilai 95,46 dalam penilaian keterbukaan informasi publik pada 30 September 2025.',
                'content'  =>
                '<p>Dinas Arsip dan Perpustakaan (Dinarpus) Kota Semarang meraih Apresiasi Kategori Informatif II dengan nilai 95,46 dalam penilaian keterbukaan informasi publik. Penghargaan ini diterima langsung oleh Kepala Dinas Arpus Kota Semarang, Bapak Bambang Suranggono, pada Selasa, 30 September 2025.</p>'
                    . '<p>Capaian ini merupakan wujud nyata komitmen Dinarpus Kota Semarang dalam membangun layanan informasi yang transparan, mudah diakses, dan bermanfaat bagi seluruh lapisan masyarakat. Penilaian keterbukaan informasi publik mencakup aspek ketersediaan informasi, kemudahan akses, serta responsivitas terhadap permohonan informasi dari masyarakat.</p>'
                    . '<p>Kepala Dinas menyampaikan bahwa penghargaan ini menjadi motivasi untuk terus meningkatkan kualitas layanan informasi publik. "Kami berkomitmen untuk terus mewujudkan layanan publik yang semakin informatif, terbuka, dan terpercaya untuk Kota Semarang," ujarnya.</p>'
                    . '<p>Ke depan, Dinarpus Kota Semarang akan terus mengoptimalkan portal informasi publik, mempercepat respon permohonan informasi, dan memperluas jenis informasi yang tersedia bagi masyarakat.</p>',
                'publication_status' => PublicationStatus::published,
                'published_at'       => now()->parse('2025-10-01'),
                'categories'         => ['prestasi'],
                'tags'               => ['ppid', 'penghargaan', 'keterbukaan', 'semarang'],
            ],

            // [2] Perkuat Layanan Melalui Media Sosial – Nov 2025
            // Sumber: arpusda.semarangkota.go.id
            [
                'title'    => 'Dinas Arpus Kota Semarang Perkuat Layanan Melalui Optimalisasi Media Sosial',
                'slug'     => 'perkuat-layanan-optimalisasi-media-sosial',
                'locale'   => 'id',
                'featured' => false,
                'intro'    => 'Dinarpus Kota Semarang mengoptimalkan pemanfaatan media sosial sebagai sarana penyebaran informasi publik dan peningkatan keterlibatan warga Kota Semarang.',
                'content'  =>
                '<p>Dinas Arsip dan Perpustakaan (Dinarpus) Kota Semarang terus berinovasi dalam memperkuat layanan informasi kepada masyarakat melalui optimalisasi berbagai platform media sosial. Langkah ini diambil sebagai bagian dari strategi komunikasi publik yang lebih modern dan menjangkau seluruh segmen masyarakat.</p>'
                    . '<p>Melalui akun resmi di berbagai platform digital, Dinarpus secara aktif membagikan informasi seputar kegiatan dinas, koleksi perpustakaan terbaru, jadwal layanan, serta informasi publik yang relevan. Konten dirancang agar mudah dipahami dan menarik bagi semua kalangan usia.</p>'
                    . '<p>Optimalisasi media sosial ini juga menjadi sarana bagi masyarakat untuk memberikan masukan, mengajukan pertanyaan, dan berinteraksi langsung dengan pihak dinas. Upaya ini sejalan dengan semangat keterbukaan informasi publik yang menjadi komitmen utama Dinarpus Kota Semarang.</p>',
                'publication_status' => PublicationStatus::published,
                'published_at'       => now()->parse('2025-11-19'),
                'categories'         => ['pengumuman'],
                'tags'               => ['semarang', 'ppid', 'keterbukaan'],
            ],

            // [3] Workshop Kupas Sejarah & Pameran Arsip – Okt 2025
            // Sumber: arpusda.semarangkota.go.id
            [
                'title'    => 'Workshop Kupas Sejarah dan Pameran Arsip Kota Semarang 2025',
                'slug'     => 'workshop-kupas-sejarah-pameran-arsip-2025',
                'locale'   => 'id',
                'featured' => false,
                'intro'    => 'Dinarpus Kota Semarang menyelenggarakan Workshop Kupas Sejarah disertai Pameran Arsip yang menampilkan koleksi dokumen dan foto bersejarah Kota Semarang.',
                'content'  =>
                '<p>Dinas Arsip dan Perpustakaan Kota Semarang menyelenggarakan Workshop Kupas Sejarah yang dipadukan dengan Pameran Arsip sebagai upaya mendekatkan kekayaan sejarah lokal kepada masyarakat. Kegiatan ini digelar pada Oktober 2025 dan terbuka untuk umum.</p>'
                    . '<p>Pameran menampilkan berbagai koleksi arsip bersejarah Kota Semarang, mulai dari dokumen tekstual, foto-foto bersejarah, hingga arsip kartografi yang merekam perkembangan wilayah Kota Semarang dari masa ke masa.</p>'
                    . '<p>Workshop menghadirkan narasumber dari kalangan sejarawan, arsiparis profesional, dan akademisi yang membahas pentingnya pelestarian arsip sebagai sumber primer penelitian sejarah. Peserta diajak untuk memahami cara membaca, mengidentifikasi, dan memanfaatkan arsip sebagai sumber informasi autentik.</p>'
                    . '<p>Melalui kegiatan ini, Dinarpus berharap dapat menumbuhkan kesadaran masyarakat akan pentingnya arsip sebagai warisan budaya yang perlu dijaga dan dilestarikan bersama.</p>',
                'publication_status' => PublicationStatus::published,
                'published_at'       => now()->parse('2025-10-17'),
                'categories'         => ['kearsipan'],
                'tags'               => ['arsip', 'semarang', 'digitalisasi'],
            ],

            // [4] Sertifikasi Akreditasi & Pengawasan Kearsipan – Okt 2025
            // Sumber: arpusda.semarangkota.go.id
            [
                'title'    => 'Penyerahan Sertifikasi Akreditasi dan Hasil Pengawasan Kearsipan Tahun 2025',
                'slug'     => 'sertifikasi-akreditasi-pengawasan-kearsipan-2025',
                'locale'   => 'id',
                'featured' => false,
                'intro'    => 'Dinas Arsip dan Perpustakaan Kota Semarang menerima sertifikasi akreditasi dari ANRI sebagai bukti pengelolaan arsip yang memenuhi standar nasional.',
                'content'  =>
                '<p>Dinas Arsip dan Perpustakaan Kota Semarang menerima Sertifikasi Akreditasi dan Hasil Pengawasan Kearsipan Tahun 2025 dari Arsip Nasional Republik Indonesia (ANRI). Penyerahan dilaksanakan pada 21 Oktober 2025 sebagai bentuk pengakuan formal atas pengelolaan kearsipan yang memenuhi standar nasional.</p>'
                    . '<p>Akreditasi kearsipan merupakan proses penilaian yang dilakukan ANRI terhadap penyelenggaraan kearsipan di lembaga pemerintah. Penilaian mencakup aspek kebijakan kearsipan, pengelolaan arsip dinamis dan statis, sumber daya manusia kearsipan, serta sarana dan prasarana.</p>'
                    . '<p>Tata kelola arsip yang baik menjamin akurasi dan keutuhan informasi sehingga informasi yang diberikan kepada publik selalu autentik dan dapat dipertanggungjawabkan. Hasil pengawasan ini menjadi acuan Dinarpus Kota Semarang untuk terus meningkatkan sistem kearsipan yang lebih transparan dan akuntabel.</p>',
                'publication_status' => PublicationStatus::published,
                'published_at'       => now()->parse('2025-10-21'),
                'categories'         => ['kearsipan', 'prestasi'],
                'tags'               => ['arsip', 'penghargaan', 'semarang'],
            ],

            // [5] Digitisasi Arsip sebagai Transformasi Kearsipan – Jun 2025
            // Sumber: arpusda.semarangkota.go.id (kutip dari ANRI)
            [
                'title'    => 'Digitisasi Arsip sebagai Transformasi Kearsipan: Pembinaan ANRI untuk Lembaga Kearsipan Daerah',
                'slug'     => 'digitisasi-arsip-transformasi-kearsipan-anri',
                'locale'   => 'id',
                'featured' => false,
                'intro'    => 'ANRI menggelar pembinaan kearsipan online bertema Digitisasi Arsip. Dinas Arsip dan Perpustakaan Kota Semarang aktif berpartisipasi sebagai bagian dari penguatan transformasi digital kearsipan daerah.',
                'content'  =>
                '<p>Arsip Nasional Republik Indonesia (ANRI) menyelenggarakan program pembinaan kearsipan secara online dengan tema "Digitisasi Arsip" pada 4 Juni 2025. Dinas Arsip dan Perpustakaan Kota Semarang turut berpartisipasi aktif dalam kegiatan ini sebagai bagian dari penguatan transformasi digital pengelolaan arsip daerah.</p>'
                    . '<p>Dalam pemaparan materi, narasumber ANRI menegaskan bahwa digitisasi arsip bukan sekadar alih media dari bentuk konvensional ke digital, melainkan merupakan upaya strategis menjaga memori kolektif bangsa, memastikan keberlanjutan informasi, serta mendukung transparansi dan akuntabilitas pemerintah.</p>'
                    . '<p>Tiga konsep penting yang dibedakan dalam kegiatan ini adalah: <strong>alih media</strong> (memindahkan arsip ke media lain tanpa mengubah isi), <strong>digitisasi</strong> (proses alih media dari analog ke digital), dan <strong>digitalisasi</strong> (transformasi kearsipan secara menyeluruh ke dalam ekosistem digital).</p>'
                    . '<p>Dinas Arsip dan Perpustakaan Kota Semarang terus berkomitmen menerapkan praktik terbaik dalam digitisasi arsip daerah sesuai standar yang ditetapkan ANRI, demi arsip yang autentik, terpercaya, dan dapat diakses oleh generasi mendatang.</p>',
                'publication_status' => PublicationStatus::published,
                'published_at'       => now()->parse('2025-06-04'),
                'categories'         => ['kearsipan'],
                'tags'               => ['digitalisasi', 'arsip', 'semarang'],
            ],

            // [6] Daftar Pencarian Arsip (DPA) – Mei 2025
            // Sumber: arpusda.semarangkota.go.id
            [
                'title'    => 'Dinas Arsip dan Perpustakaan Kota Semarang Umumkan Daftar Pencarian Arsip (DPA) Tahun 2025',
                'slug'     => 'daftar-pencarian-arsip-dpa-2025',
                'locale'   => 'id',
                'featured' => false,
                'intro'    => 'Dalam rangka penyelamatan arsip, Dinarpus Kota Semarang mengumumkan Daftar Pencarian Arsip (DPA) Tahun 2025. Masyarakat yang menemukan arsip terkait dimohon untuk melapor.',
                'content'  =>
                '<p>Dalam rangka penyelamatan arsip yang dicari keberadaannya sesuai amanat Pasal 60 ayat 3 Undang-Undang Nomor 43 Tahun 2009 tentang Kearsipan, Dinas Arsip dan Perpustakaan Kota Semarang mengumumkan Daftar Pencarian Arsip (DPA) Tahun 2025.</p>'
                    . '<p>Arsip-arsip yang sedang dicari antara lain:</p>'
                    . '<ul>'
                    . '<li><strong>Arsip Wali Kota Semarang (Hadijanto)</strong> — Tekstual, Foto, Audio Visual, periode 1973–1980</li>'
                    . '<li><strong>Arsip Tokoh Tasripin (Saudagar Pribumi)</strong> — Tekstual dan Foto</li>'
                    . '<li><strong>Arsip Pemekaran Wilayah Kota Semarang</strong> — Tekstual, Foto, dan Kartografi, periode 1976/1992</li>'
                    . '</ul>'
                    . '<p>Bagi masyarakat yang memiliki atau menemukan arsip tersebut, diwajibkan memberitahukan keberadaan dan/atau menyerahkan arsip kepada Dinas Arsip dan Perpustakaan Kota Semarang di Jl. Prof. Sudarto No. 116, Kel. Sumurboto, Kec. Banyumanik, Kota Semarang.</p>'
                    . '<p>Arsip yang diterima harus memenuhi syarat: <strong>autentik, terpercaya, utuh, dan dapat digunakan</strong>. Informasi lebih lanjut dapat diperoleh dengan menghubungi kantor Dinarpus pada hari dan jam kerja.</p>',
                'publication_status' => PublicationStatus::published,
                'published_at'       => now()->parse('2025-05-27'),
                'categories'         => ['kearsipan', 'pengumuman'],
                'tags'               => ['arsip', 'semarang', 'ppid'],
            ],

            // [7] Semarang Berpuisi – Okt 2025
            // Sumber: arpusda.semarangkota.go.id
            [
                'title'    => 'Semarang Berpuisi: Bunda Literasi Menginspirasi Sejuta Kata',
                'slug'     => 'semarang-berpuisi-bunda-literasi-2025',
                'locale'   => 'id',
                'featured' => false,
                'intro'    => 'Kegiatan Semarang Berpuisi yang diinisiasi Bunda Literasi Kota Semarang menginspirasi ribuan warga untuk mengekspresikan kecintaan terhadap sastra dan budaya membaca.',
                'content'  =>
                '<p>Kota Semarang kembali merayakan kecintaan terhadap sastra dan literasi melalui kegiatan "Semarang Berpuisi" yang diinisiasi oleh Bunda Literasi Kota Semarang pada Oktober 2025. Kegiatan ini berhasil menginspirasi ribuan warga dari berbagai kalangan untuk mengekspresikan pikiran dan perasaan melalui puisi.</p>'
                    . '<p>Acara melibatkan peserta dari berbagai kelompok usia, mulai dari pelajar sekolah dasar hingga komunitas sastra dewasa. Para peserta berkesempatan membacakan karya puisi mereka di hadapan publik, sekaligus menyimak pembacaan puisi dari penyair tamu yang diundang.</p>'
                    . '<p>Dinas Arsip dan Perpustakaan Kota Semarang turut berperan aktif dalam penyelenggaraan kegiatan ini sebagai bagian dari program penguatan literasi masyarakat. Perpustakaan Kota Semarang menyediakan ruang baca dan koleksi antologi puisi yang dapat diakses oleh seluruh peserta secara gratis.</p>',
                'publication_status' => PublicationStatus::published,
                'published_at'       => now()->parse('2025-10-15'),
                'categories'         => ['literasi', 'perpustakaan'],
                'tags'               => ['literasi', 'semarang', 'perpustakaan'],
            ],

            // [8] Antologi Cerpen – Nov 2025
            // Sumber: arpusda.semarangkota.go.id
            [
                'title'    => 'Wali Kota Agustin Luncurkan Antologi Cerpen "Kampungku dan Kota Semarang"',
                'slug'     => 'antologi-cerpen-kampungku-kota-semarang',
                'locale'   => 'id',
                'featured' => false,
                'intro'    => 'Wali Kota Semarang meluncurkan antologi cerpen "Kampungku dan Kota Semarang" sebagai apresiasi terhadap karya sastra lokal dan penguatan identitas budaya kota.',
                'content'  =>
                '<p>Wali Kota Semarang, Agustin Widjajanti, meluncurkan antologi cerpen bertajuk <em>"Kampungku dan Kota Semarang"</em> pada 14 November 2025. Peluncuran buku ini merupakan wujud apresiasi Pemerintah Kota Semarang terhadap karya sastra lokal sekaligus upaya memperkuat identitas budaya masyarakat kota.</p>'
                    . '<p>Antologi cerpen ini memuat karya-karya terpilih dari penulis lokal Semarang yang mengangkat tema kehidupan, sejarah, dan budaya kampung-kampung di Kota Semarang. Karya-karya tersebut tidak hanya merekam memori kolektif masyarakat, tetapi juga menjadi dokumen sastra berharga bagi generasi mendatang.</p>'
                    . '<p>Dinas Arsip dan Perpustakaan Kota Semarang menambahkan antologi ini ke dalam koleksi Perpustakaan Kota Semarang dan dapat dipinjam oleh seluruh anggota perpustakaan secara gratis sebagai bagian dari program peningkatan literasi masyarakat.</p>'
                    . '<p>"Karya sastra adalah cermin peradaban kota. Melalui buku ini, kita menjaga ingatan tentang Semarang untuk anak cucu kita," ujar Wali Kota dalam sambutannya.</p>',
                'publication_status' => PublicationStatus::published,
                'published_at'       => now()->parse('2025-11-14'),
                'categories'         => ['literasi', 'perpustakaan'],
                'tags'               => ['literasi', 'semarang', 'perpustakaan'],
            ],

        ];

        foreach ($posts as $postData) {
            $categoryKeys = $postData['categories'];
            $tagKeys      = $postData['tags'];
            unset($postData['categories'], $postData['tags']);

            $post = NewsPost::firstOrCreate(
                ['slug' => $postData['slug'], 'locale' => $postData['locale']],
                array_merge($postData, ['preview_token' => Str::random(32)])
            );

            $post->categories()->sync(
                collect($categoryKeys)->map(fn($k) => $cat[$k]->id ?? null)->filter()->toArray()
            );

            $post->tags()->sync(
                collect($tagKeys)->map(fn($k) => $tag[$k]->id ?? null)->filter()->toArray()
            );
        }

        $this->command->info('✅ NewsSeeder selesai: '
            . count($categories) . ' kategori, '
            . count($tags) . ' tag, '
            . count($posts) . ' berita nyata dari Dinarpus Kota Semarang.');
    }
}
