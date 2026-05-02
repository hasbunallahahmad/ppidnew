<?php

namespace App\Http\Controllers;

use App\Models\PermohonanInformasi;
use App\Http\Requests\StorePermohonanRequest;

class PermohonanController extends Controller
{
    // =========================================================
    // Kolom yang aman ditampilkan ke publik pada halaman lacak.
    // Tidak menyertakan: no_identitas, no_telepon, ip_address.
    // =========================================================
    private const PUBLIC_COLUMNS = [
        'nomor_tiket',
        'nama_pemohon',
        'email',            // Di-mask di blade: j***@gmail.com
        'status',
        'deadline_at',
        'selesai_at',
        'catatan_admin',
        'alasan_penolakan',
        'informasi_diminta',
        'tujuan_penggunaan',
        'created_at',
    ];

    public function carePermohonan()
    {
        return view('pages.permohonan.cara-permohonan', [
            'pageTitle'       => 'Cara Pengajuan Permohonan Informasi',
            'pageDescription' => 'Panduan lengkap cara mengajukan permohonan informasi melalui PPID',
        ]);
    }

    public function form()
    {
        return view('pages.permohonan.form', [
            'pageTitle'       => 'Formulir Pengajuan Permohonan Informasi',
            'pageDescription' => 'Isi formulir di bawah untuk mengajukan permohonan informasi',
        ]);
    }

    public function store(StorePermohonanRequest $request)
    {
        $validated = $request->validated();

        $permohonan = PermohonanInformasi::create([
            ...$validated,
            'status'     => 'masuk',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('permohonan.success')
            ->with('success', 'Permohonan Anda telah berhasil diajukan!')
            ->with('nomor_tiket', $permohonan->nomor_tiket);
    }

    public function success()
    {
        // Jika user langsung akses URL ini tanpa sesi, kembalikan ke form
        if (! session()->has('nomor_tiket')) {
            return redirect()->route('permohonan.form');
        }

        return view('pages.permohonan.success', [
            'pageTitle'   => 'Permohonan Berhasil Diajukan',
            'nomor_tiket' => session('nomor_tiket'),
        ]);
    }

    public function lacakPermohonan()
    {
        $nomorTiket = request('nomor_tiket');
        $permohonan = null;
        $error      = null;

        if ($nomorTiket) {
            $nomorTiket = strtoupper(trim($nomorTiket));

            // Format: PPID-2026-S4NSGJ (sesuai generateNomorTiket())
            if (! preg_match('/^PPID-\d{4}-[A-Z0-9]{6}$/', $nomorTiket)) {
                $error = 'Format nomor tiket tidak valid. Contoh format yang benar: PPID-2026-S4NSGJ';
            } else {
                $permohonan = PermohonanInformasi::where('nomor_tiket', $nomorTiket)
                    ->select(self::PUBLIC_COLUMNS)
                    ->first();

                if (! $permohonan) {
                    $error = 'Nomor tiket tidak ditemukan. Periksa kembali nomor tiket Anda.';
                }
            }
        }

        return view('pages.permohonan.lacak', [
            'pageTitle'       => 'Lacak Status Permohonan',
            'pageDescription' => 'Masukkan nomor tiket permohonan untuk melihat status dan detail permohonan Anda',
            'permohonan'      => $permohonan,
            'error'           => $error,
        ]);
    }

    /**
     * Endpoint opsional: akses langsung via URL /permohonan/status/{nomor_tiket}
     * Contoh dari email notifikasi.
     */
    public function checkStatus(string $nomorTiket)
    {
        $nomorTiket = strtoupper(trim($nomorTiket));

        if (! preg_match('/^PPID-\d{4}-[A-Z0-9]{6}$/', $nomorTiket)) {
            abort(404);
        }

        $permohonan = PermohonanInformasi::where('nomor_tiket', $nomorTiket)
            ->select(self::PUBLIC_COLUMNS)
            ->first();

        if (! $permohonan) {
            abort(404);
        }

        return view('pages.permohonan.status', compact('permohonan'));
    }
}
