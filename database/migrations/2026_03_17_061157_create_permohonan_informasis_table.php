<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonan_informasis', function (Blueprint $table) {
            $table->id();

            // --- Data Pemohon ---
            $table->string('nama_pemohon', 150);
            $table->string('email', 150);
            $table->string('no_telepon', 20)->nullable();
            $table->text('alamat')->nullable();

            // Identitas: KTP/SIM/Paspor (opsional, untuk verifikasi)
            $table->string('jenis_identitas', 30)->nullable(); // ktp|sim|paspor
            $table->string('no_identitas', 30)->nullable();

            // --- Data Permohonan ---
            $table->text('informasi_diminta');
            $table->text('tujuan_penggunaan')->nullable();

            // Cara mendapatkan: salinan/melihat_langsung/email
            $table->string('cara_mendapatkan', 30)->default('salinan');

            // --- Tracking ---
            // Nomor tiket unik untuk tracking oleh pemohon
            // Format: PPID-YYYYMMDD-XXXX
            $table->string('nomor_tiket', 30)->unique();

            $table->enum('status', [
                'masuk',      // baru diterima
                'diproses',   // sedang ditangani petugas
                'selesai',    // sudah direspons/dikirim
                'ditolak',    // ditolak dengan alasan
                'banding',    // pemohon mengajukan banding
            ])->default('masuk');

            // Catatan internal admin (tidak ditampilkan ke pemohon)
            $table->text('catatan_admin')->nullable();

            // Alasan penolakan (ditampilkan ke pemohon jika status = ditolak)
            $table->text('alasan_penolakan')->nullable();

            // Deadline respon: +10 hari kerja dari tanggal masuk (sesuai UU KIP)
            $table->date('deadline_at')->nullable();

            // Tanggal benar-benar diselesaikan
            $table->timestamp('selesai_at')->nullable();

            // IP address pemohon untuk audit
            $table->string('ip_address', 45)->nullable();

            $table->timestamps();
            $table->softDeletes();

            // --- Indexes ---
            // Filter status di dashboard admin (paling sering)
            $table->index('status');

            // Filter per tanggal untuk laporan bulanan
            $table->index('created_at');

            // Monitoring deadline (permohonan yang hampir jatuh tempo)
            $table->index(['status', 'deadline_at']);

            // Cari permohonan by email (pemohon cek status)
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_informasis');
    }
};
