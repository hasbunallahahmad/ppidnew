<?php

namespace App\Http\Controllers;

use App\Services\StatistikService;
use Novius\LaravelFilamentNews\Models\NewsPost;

class HomeController extends Controller
{
    public function __construct(
        protected StatistikService $statistikService,
    ) {}

    public function index()
    {
        // ── Statistik Utama ───────────────────────────────────
        $stats = [
            ['icon' => 'fas fa-file-alt',    'color' => 'blue',   'value' => '8.240',  'label' => 'Dokumen Arsip Digital',     'suffix' => ''],
            ['icon' => 'fas fa-book',        'color' => 'green',  'value' => '42.680', 'label' => 'Koleksi Buku Perpustakaan', 'suffix' => ''],
            ['icon' => 'fas fa-users',       'color' => 'teal',   'value' => '1.482',  'label' => 'Permohonan Informasi',      'suffix' => ''],
            ['icon' => 'fas fa-check-circle', 'color' => 'orange', 'value' => '1.451',  'label' => 'Permohonan Selesai',        'suffix' => ''],
            ['icon' => 'fas fa-star',        'color' => 'yellow', 'value' => '97,8',   'label' => 'Tingkat Kepuasan',          'suffix' => '%'],
            ['icon' => 'fas fa-clock',       'color' => 'purple', 'value' => '3,5',    'label' => 'Rata-rata Hari Respon',     'suffix' => ' hari'],
        ];

        // ── Layanan / Kategori Konten ─────────────────────────
        $layanans = [
            ['icon' => 'fas fa-newspaper',   'color' => 'blue',   'title' => 'Berita & Pengumuman',   'desc' => 'Berita terkini, siaran pers, dan pengumuman resmi Dinas Arsip dan Perpustakaan Kota Semarang.',        'count' => '124 artikel',    'link' => '#'],
            ['icon' => 'fas fa-archive',     'color' => 'green',  'title' => 'Arsip Digital',         'desc' => 'Koleksi arsip statis dan dinamis yang telah didigitalisasi dan dapat diakses oleh masyarakat.',       'count' => '8.240 arsip',    'link' => '#'],
            ['icon' => 'fas fa-book-open',   'color' => 'orange', 'title' => 'Katalog Perpustakaan',  'desc' => 'Katalog koleksi buku, jurnal, e-book, dan referensi digital Perpustakaan Kota Semarang.',             'count' => '42.680 koleksi', 'link' => '#'],
            ['icon' => 'fas fa-images',      'color' => 'teal',   'title' => 'Infografis',            'desc' => 'Penyajian informasi kearsipan dan perpustakaan dalam bentuk visual yang informatif.',                 'count' => '56 infografis',  'link' => '#'],
            ['icon' => 'fas fa-file-pdf',    'color' => 'red',    'title' => 'Dokumen & Regulasi',    'desc' => 'Peraturan, SK, SOP, dan dokumen resmi terkait kearsipan dan perpustakaan daerah.',                   'count' => '318 dokumen',    'link' => '#'],
            ['icon' => 'fas fa-chart-bar',   'color' => 'purple', 'title' => 'Statistik Layanan',     'desc' => 'Data statistik kunjungan perpustakaan, peminjaman buku, dan layanan arsip tahunan.',                  'count' => '48 dataset',     'link' => '#'],
        ];

        // ── Berita dari Database ──────────────────────────────
        // Ambil 5 berita terpublish terbaru, eager load relasi categories
        $allBerita = NewsPost::published()
            ->with('categories')
            ->latest('published_at')
            ->limit(5)
            ->get();

        // Berita utama = postingan paling baru (atau yang di-featured jika ada)
        $beritaFeatured = $allBerita->firstWhere('featured', true) ?? $allBerita->first();

        // Berita list = sisanya (tanpa featured), maks 4 item
        $beritaList = $allBerita
            ->filter(fn($p) => $beritaFeatured && $p->id !== $beritaFeatured->id)
            ->take(4)
            ->values();

        // ── Infografis ────────────────────────────────────────
        $infografis = [
            ['icon' => 'fas fa-chart-pie',   'color' => 'blue',   'judul' => 'Statistik Kunjungan Perpustakaan Kota Semarang 2024',  'views' => '4.210', 'tanggal' => 'Feb 2025', 'link' => '#'],
            ['icon' => 'fas fa-archive',     'color' => 'green',  'judul' => 'Capaian Digitalisasi Arsip Daerah Tahun 2024',         'views' => '3.087', 'tanggal' => 'Jan 2025', 'link' => '#'],
            ['icon' => 'fas fa-book-reader', 'color' => 'orange', 'judul' => 'Profil Minat Baca Masyarakat Kota Semarang 2024',      'views' => '5.340', 'tanggal' => 'Des 2024', 'link' => '#'],
            ['icon' => 'fas fa-layer-group', 'color' => 'teal',   'judul' => 'Rekapitulasi Koleksi Perpustakaan Per Kategori 2024',  'views' => '1.890', 'tanggal' => 'Nov 2024', 'link' => '#'],
        ];

        // ── Statistik Kunjungan Perpustakaan (Bar Chart) ──────
        $statistikKearsipan = $this->statistikService->kearsipan();
        $statistikKunjungan = $this->statistikService->kunjungan();

        // ── Daftar Informasi Publik ───────────────────────────
        $daftarInformasi = [
            ['icon' => 'fas fa-calendar-check', 'color' => 'blue',   'judul' => 'Informasi Berkala',      'desc' => 'Laporan tahunan, profil dinas, rencana kerja, dan anggaran yang diumumkan secara berkala.',                   'count' => '84',  'badge' => 'Wajib Ada',     'link' => '#'],
            ['icon' => 'fas fa-infinity',        'color' => 'green',  'judul' => 'Informasi Setiap Saat',  'desc' => 'Katalog arsip publik, koleksi perpustakaan, SOP layanan, dan informasi yang selalu tersedia.',               'count' => '426', 'badge' => 'Tersedia 24/7', 'link' => '#'],
            ['icon' => 'fas fa-bolt',            'color' => 'orange', 'judul' => 'Informasi Serta Merta',  'desc' => 'Informasi mendesak terkait layanan darurat, kerusakan arsip, atau penutupan layanan mendadak.',              'count' => '12',  'badge' => 'Darurat',       'link' => '#'],
            ['icon' => 'fas fa-lock',            'color' => 'gray',   'judul' => 'Informasi Dikecualikan', 'desc' => 'Arsip bersifat rahasia negara dan informasi yang dikecualikan sesuai peraturan perundang-undangan.',         'count' => '8',   'badge' => 'Terbatas',      'link' => '#'],
        ];

        return view('pages.home', compact(
            'stats',
            'layanans',
            'beritaFeatured',
            'beritaList',
            'infografis',
            'statistikKearsipan',
            'statistikKunjungan',
            'daftarInformasi',
        ));
    }
}
