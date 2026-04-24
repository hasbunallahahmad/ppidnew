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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();

            // --- Foreign Key ---
            // nullOnDelete() agar dokumen tidak terhapus jika kategori dihapus
            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategoris')
                ->nullOnDelete();

            // --- Core Fields ---
            $table->string('judul', 300);
            $table->string('slug', 320)->unique();
            $table->text('deskripsi')->nullable();

            // Tipe informasi sesuai UU No. 14 Tahun 2008 tentang KIP
            $table->enum('tipe_informasi', [
                'berkala',       // wajib diumumkan berkala (min 6 bulan)
                'setiap_saat',   // tersedia setiap saat, bisa diminta kapanpun
                'serta_merta',   // ancaman hajat hidup orang banyak
                'dikecualikan',  // dikecualikan sesuai peraturan
            ]);

            // Tahun dokumen untuk filter di tabel daftar informasi
            $table->year('tahun')->nullable();

            // Nama file original untuk display (path disimpan via Spatie Media Library)
            $table->string('nama_file_original', 255)->nullable();

            // Ukuran file dalam bytes (opsional, untuk info download)
            $table->unsignedBigInteger('ukuran_file')->nullable();

            // Mimetype untuk validasi dan icon
            $table->string('mime_type', 100)->nullable();

            $table->boolean('is_active')->default(true);

            // Counter download untuk statistik
            $table->unsignedBigInteger('downloads')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // --- Indexes ---
            // Query utama: filter per tipe informasi (untuk 4 card daftar informasi)
            $table->index('tipe_informasi');
            $table->index(['tipe_informasi', 'is_active']);

            // Filter per kategori + tipe
            $table->index(['kategori_id', 'tipe_informasi']);

            // Filter per tahun (sering dipakai di halaman daftar)
            $table->index('tahun');

            // Full-text search untuk pencarian dokumen
            $table->fullText(['judul', 'deskripsi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
