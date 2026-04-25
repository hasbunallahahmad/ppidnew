<?php

namespace App\Http\Controllers;

use App\Models\PermohonanInformasi;
use App\Http\Requests\StorePermohonanRequest;

class PermohonanController extends Controller
{
    public function carePermohonan()
    {
        return view('pages.permohonan.cara-permohonan', [
            'pageTitle' => 'Cara Pengajuan Permohonan Informasi',
            'pageDescription' => 'Panduan lengkap cara mengajukan permohonan informasi melalui PPID',
        ]);
    }

    public function form()
    {
        return view('pages.permohonan.form', [
            'pageTitle' => 'Formulir Pengajuan Permohonan Informasi',
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
        $nomorTiket = session('nomor_tiket');

        return view('pages.permohonan.success', [
            'pageTitle' => 'Permohonan Berhasil Diajukan',
            'nomor_tiket' => $nomorTiket,
        ]);
    }
    public function lacakPermohonan()
    {
        $nomorTiket = request('nomor_tiket');
        $permohonan = null;
        $error      = null;

        if ($nomorTiket) {
            if (! preg_match('/^PPID-\d{4}-[A-Z0-9]{6}$/', strtoupper(trim($nomorTiket)))) {
                $error = 'Format nomor tiket tidak valid. Contoh format: PPID-2026-ABCD12';
            } else {
                $permohonan = PermohonanInformasi::where('nomor_tiket', strtoupper(trim($nomorTiket)))
                    ->select([
                        'nomor_tiket',
                        'nama_pemohon',
                        'status',
                        'deadline_at',
                        'selesai_at',
                        'catatan_admin',
                        'created_at',
                    ])
                    ->first();
                if (! $permohonan) {
                    $error = 'Nomor tiket tidak ditemukan.';
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

    public function checkStatus(string $nomorTiket)
    {
        $nomorTiket = strtoupper(trim($nomorTiket));
        if (! preg_match('/^PPID-\d{4}-[A-Z0-9]{6}$/', $nomorTiket)) {
            abort(404);
        }
        $permohonan = PermohonanInformasi::where('nomor_tiket', $nomorTiket)
            ->select([
                'nomor_tiket',
                'nama_pemohon',
                'status',
                'deadline_at',
                'selesai_at',
                'catatan_admin',
                'created_at',
            ])
            ->first();

        if (! $permohonan) {
            abort(404);
        }

        return view('pages.permohonan.status', compact('permohonan'));
    }
}
