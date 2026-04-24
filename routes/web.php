<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuPageController;
use App\Http\Controllers\PermohonanController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * Menu Pages Routes
 * Routes untuk semua halaman yang ditampilkan dari menu navbar
 */
Route::prefix('page')->name('page.')->group(function () {
    // Profil Dinas
    Route::get('/tentang-dinas', [MenuPageController::class, 'tentangDinas'])->name('tentang-dinas');
    Route::get('/struktur-organisasi', [MenuPageController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
    Route::get('/visi-misi', [MenuPageController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/dasar-hukum', [MenuPageController::class, 'dasarHukum'])->name('dasar-hukum');
    Route::get('/profil-ppid', [MenuPageController::class, 'profilPPID'])->name('profil-ppid');

    // Informasi Publik
    Route::get('/informasi-berkala', [MenuPageController::class, 'informasiBerkala'])->name('informasi-berkala');
    Route::get('/informasi-setiap-saat', [MenuPageController::class, 'informasiSetiapSaat'])->name('informasi-setiap-saat');
    Route::get('/informasi-serta-merta', [MenuPageController::class, 'informasiSertaMerta'])->name('informasi-serta-merta');
    Route::get('/informasi-dikecualikan', [MenuPageController::class, 'informasiDikecualikan'])->name('informasi-dikecualikan');
    //   Route::get('/statistik-layanan', [MenuPageController::class, 'statistikLayanan'])->name('statistik-layanan');

    // Layanan Arsip
    Route::get('/arsip-digital', [MenuPageController::class, 'arsipDigital'])->name('arsip-digital');
    Route::get('/akuisisi-arsip', [MenuPageController::class, 'akuisisiArsip'])->name('akuisisi-arsip');
    Route::get('/restorasi-konservasi', [MenuPageController::class, 'restorasi'])->name('restorasi');
    Route::get('/depo-arsip', [MenuPageController::class, 'depoArsip'])->name('depo-arsip');
    Route::get('/bimbingan-teknis', [MenuPageController::class, 'bimbinganTeknis'])->name('bimbingan-teknis');

    // Layanan Perpustakaan
    Route::get('/katalog-koleksi', [MenuPageController::class, 'katalogKoleksi'])->name('katalog-koleksi');
    Route::get('/e-library', [MenuPageController::class, 'eLibrary'])->name('e-library');
    Route::get('/taman-baca', [MenuPageController::class, 'tamanBaca'])->name('taman-baca');
    Route::get('/inklusi-sosial', [MenuPageController::class, 'inklusiSosial'])->name('inklusi-sosial');

    // Download PDF
    Route::get('/download-pdf/{filename}', [MenuPageController::class, 'downloadPdf'])->name('download-pdf');
});

/**
 * Permohonan Informasi Routes
 * Routes untuk pengajuan permohonan informasi publik
 */
Route::prefix('permohonan')->name('permohonan.')->group(function () {
    // Halaman cara permohonan
    Route::get('/cara', [PermohonanController::class, 'carePermohonan'])->name('care');

    // Form pengajuan
    Route::get('/form', [PermohonanController::class, 'form'])->name('form');
    Route::post('/store', [PermohonanController::class, 'store'])->name('store');

    // Halaman sukses
    Route::get('/success', [PermohonanController::class, 'success'])->name('success');

    // Cek status permohonan (dengan nomor tiket)
    Route::get('/status/{nomorTiket}', [PermohonanController::class, 'checkStatus'])->name('status');

    // Halaman cari berdasarkan nomor tiket (submenu)
    Route::get('/lacak', [PermohonanController::class, 'lacakPermohonan'])->name('lacak');
});

Route::get('news/posts', [\App\Http\Controllers\NewsController::class, 'posts'])->name('news.posts');

Route::get('news/posts/{post}', [\App\Http\Controllers\NewsController::class, 'post'])->name('news.post');

Route::get('news/categories', [\App\Http\Controllers\NewsController::class, 'categories'])->name('news.categories');

Route::get('news/categories/{category}', [\App\Http\Controllers\NewsController::class, 'category'])->name('news.category');

Route::get('news/tags/{tag}', [\App\Http\Controllers\NewsController::class, 'tag'])->name('news.tag');
