<?php

namespace App\Http\Controllers;

use App\Models\PermohonanInformasi;
use App\Http\Requests\StorePermohonanRequest;
use Illuminate\Support\Str;

class PermohonanController extends Controller
{
    /**
     * Tampilkan halaman cara pengajuan permohonan
     */
    public function carePermohonan()
    {
        return view('pages.permohonan.cara-permohonan', [
            'pageTitle' => 'Cara Pengajuan Permohonan Informasi',
            'pageDescription' => 'Panduan lengkap cara mengajukan permohonan informasi melalui PPID',
        ]);
    }

    /**
     * Tampilkan halaman lacak/status permohonan berdasarkan nomor tiket
     */
    public function lacakPermohonan()
    {
        $nomorTiket = request('nomor_tiket');
        $permohonan = null;

        if ($nomorTiket) {
            // Cari permohonan berdasarkan nomor tiket
            $permohonan = PermohonanInformasi::where('nomor_tiket', $nomorTiket)->first();

            // Jika tidak ditemukan, bisa tambahkan handling jika perlu
            // Tapi biarkan view yang handle error message
        }

        return view('pages.permohonan.lacak', [
            'pageTitle' => 'Lacak Status Permohonan',
            'pageDescription' => 'Masukkan nomor tiket permohonan untuk melihat status dan detail permohonan Anda',
            'permohonan' => $permohonan,
        ]);
    }

    /**
     * Tampilkan form pengajuan permohonan
     */
    public function form()
    {
        return view('pages.permohonan.form', [
            'pageTitle' => 'Formulir Pengajuan Permohonan Informasi',
            'pageDescription' => 'Isi formulir di bawah untuk mengajukan permohonan informasi',
        ]);
    }

    /**
     * Simpan permohonan baru
     */
    public function store(StorePermohonanRequest $request)
    {
        $validated = $request->validated();

        // Additional security: Rate limiting check
        $recentSubmissions = PermohonanInformasi::where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subHour())
            ->count();

        if ($recentSubmissions >= 5) {
            return back()
                ->withErrors(['error' => 'Terlalu banyak permohonan. Silakan tunggu 1 jam sebelum mengajukan kembali.'])
                ->withInput();
        }

        // Generate nomor tiket unik
        // $nomorTiket = 'PRM-' . strtoupper(Str::random(8)) . '-' . date('YmdHis');

        // Simpan permohonan dengan data yang sudah disanitasi
        $permohonan = PermohonanInformasi::create([
            ...$validated,
            // 'nomor_tiket' => $nomorTiket,
            'status' => 'masuk', // Default status untuk permohonan baru
            'ip_address' => $request->ip(),
        ]);

        // TODO: Trigger event untuk notifikasi admin jika sudah ada listener

        return redirect()->route('permohonan.success')
            ->with('success', 'Permohonan Anda telah berhasil diajukan!')
            ->with('nomor_tiket', $permohonan->nomor_tiket);
    }

    /**
     * Tampilkan halaman sukses setelah pengajuan
     */
    public function success()
    {
        $nomorTiket = session('nomor_tiket');

        return view('pages.permohonan.success', [
            'pageTitle' => 'Permohonan Berhasil Diajukan',
            'nomor_tiket' => $nomorTiket,
        ]);
    }

    /**
     * Tampilkan status permohonan berdasarkan nomor tiket
     */
    public function checkStatus($nomorTiket)
    {
        $permohonan = PermohonanInformasi::where('nomor_tiket', $nomorTiket)
            ->firstOrFail();

        return view('pages.permohonan.status', [
            'pageTitle' => 'Status Permohonan Informasi',
            'permohonan' => $permohonan,
        ]);
    }
}
