<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MenuPageController extends Controller
{
    /**
     * Tampilkan halaman menu berdasarkan slug
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.menu.page-detail', [
            'page' => $page,
            'pageTitle' => $page->title,
            'pageDescription' => $page->description,
        ]);
    }

    /**
     * Tampilkan halaman Tentang Dinas
     */
    public function tentangDinas()
    {
        return $this->show('tentang-dinas');
    }

    /**
     * Tampilkan halaman Struktur Organisasi
     */
    public function strukturOrganisasi()
    {
        return $this->show('struktur-organisasi');
    }

    /**
     * Tampilkan halaman Visi & Misi
     */
    public function visiMisi()
    {
        return $this->show('visi-misi');
    }

    /**
     * Tampilkan halaman Dasar Hukum
     */
    public function dasarHukum()
    {
        return $this->show('dasar-hukum');
    }

    /**
     * Tampilkan halaman Profil PPID
     */
    public function profilPPID()
    {
        return $this->show('profil-ppid');
    }

    /**
     * Tampilkan halaman Informasi Berkala
     */
    public function informasiBerkala()
    {
        $page = Page::where('slug', 'informasi-berkala')->firstOrFail();

        return view('pages.menu.informasi-berkala', [
            'page' => $page,
            'pageTitle' => $page->title,
            'pageDescription' => $page->description,
        ]);
    }

    /**
     * Tampilkan halaman Informasi Setiap Saat
     */
    public function informasiSetiapSaat()
    {
        // Get page content from database
        $page = Page::where('slug', 'informasi-setiap-saat')->first();

        // Get current year from server timezone
        $currentYear = now()->year;

        // Get selected year from request parameter (default to current year)
        $selectedYear = request('tahun', $currentYear);

        // Get all available years for 'setiap_saat' documents (active, ordered desc)
        $availableYears = Dokumen::tipe('setiap_saat')
            ->active()
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->all();

        // Ensure current year is included if no documents exist yet
        if (empty($availableYears)) {
            $availableYears = [$currentYear];
        } elseif (!in_array($currentYear, $availableYears)) {
            $availableYears[] = $currentYear;
            rsort($availableYears);
        }

        // Get documents for selected year, grouped by kategori
        $dokumenPerKategori = Dokumen::tipe('setiap_saat')
            ->active()
            ->byTahun($selectedYear)
            ->with('kategori')
            ->orderBy('kategori_id')
            ->orderBy('judul')
            ->get()
            ->groupBy(function ($dokumen) {
                return $dokumen->kategori?->nama ?? 'Tanpa Kategori';
            });

        return view('pages.menu.informasi-setiap-saat', [
            'page' => $page,
            'dokumenPerKategori' => $dokumenPerKategori,
            'availableYears' => $availableYears,
            'selectedYear' => $selectedYear,
            'currentYear' => $currentYear,
            'pageTitle' => 'Informasi Setiap Saat',
            'pageDescription' => 'Informasi setiap saat yang dapat diakses kapan saja',
        ]);
    }

    /**
     * Tampilkan halaman Informasi Serta Merta
     */
    public function informasiSertaMerta()
    {
        $page = Page::where('slug', 'informasi-serta-merta')->firstOrFail();

        return view('pages.menu.informasi-serta-merta', [
            'page'            => $page,
            'pageTitle'       => $page->title,
            'pageDescription' => $page->description,
        ]);
    }

    /**
     * Tampilkan halaman Informasi Dikecualikan
     */
    public function informasiDikecualikan()
    {
        $page = Page::where('slug', 'informasi-dikecualikan')->firstOrFail();

        return view('pages.menu.informasi-dikecualikan', [
            'page'            => $page,
            'pageTitle'       => $page->title,
            'pageDescription' => $page->description,
        ]);
    }

    /**
     * Tampilkan halaman Statistik Layanan
     */
    public function statistikLayanan()
    {
        return $this->show('statistik-layanan');
    }

    /**
     * Tampilkan halaman Arsip Digital
     */
    public function arsipDigital()
    {
        return $this->show('arsip-digital');
    }

    /**
     * Tampilkan halaman Akuisisi Arsip
     */
    public function akuisisiArsip()
    {
        return $this->show('akuisisi-arsip');
    }

    /**
     * Tampilkan halaman Restorasi & Konservasi
     */
    public function restorasi()
    {
        return $this->show('restorasi');
    }

    /**
     * Tampilkan halaman Depo Arsip Daerah
     */
    public function depoArsip()
    {
        return $this->show('depo-arsip');
    }

    /**
     * Tampilkan halaman Bimbingan Teknis
     */
    public function bimbinganTeknis()
    {
        return $this->show('bimbingan-teknis');
    }

    /**
     * Tampilkan halaman Katalog Koleksi
     */
    public function katalogKoleksi()
    {
        return $this->show('katalog-koleksi');
    }

    /**
     * Tampilkan halaman E-Library & E-Book
     */
    public function eLibrary()
    {
        return $this->show('e-library');
    }

    /**
     * Tampilkan halaman Taman Baca Masyarakat
     */
    public function tamanBaca()
    {
        return $this->show('taman-baca');
    }

    /**
     * Tampilkan halaman Layanan Inklusi Sosial
     */
    public function inklusiSosial()
    {
        return $this->show('inklusi-sosial');
    }

    /**
     * Download PDF file dengan Content-Disposition header
     */
    public function downloadPdf($filename)
    {
        $filepath = 'pages-pdf/' . urldecode($filename);

        if (!Storage::disk('public')->exists($filepath)) {
            abort(404, 'File tidak ditemukan');
        }

        $fullPath = Storage::disk('public')->path($filepath);

        return response()->download(
            $fullPath,
            urldecode($filename),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . urldecode($filename) . '"'
            ]
        );
    }
}
