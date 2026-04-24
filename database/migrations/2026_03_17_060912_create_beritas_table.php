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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();

            // --- Foreign Keys ---
            // constrained() otomatis referensikan tabel 'kategoris' kolom 'id'
            // nullOnDelete() agar berita tidak ikut terhapus jika kategori dihapus,
            // melainkan kategori_id menjadi NULL (lebih aman untuk konten)
            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategoris')
                ->nullOnDelete();

            // Author: jika user dihapus, berita tetap ada tapi author_id jadi NULL
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // --- Core Fields ---
            $table->string('judul', 300);

            // Slug unik untuk URL: /berita/{slug}
            $table->string('slug', 320)->unique();

            // Ringkasan untuk card preview & meta description (max 500 char)
            $table->string('ringkasan', 500)->nullable();

            // Konten HTML full dari RichEditor Filament
            $table->longText('konten');

            // Status publikasi
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            // Flag untuk tampil di featured section homepage
            $table->boolean('is_featured')->default(false);

            // Counter views - update langsung saat halaman dibuka
            $table->unsignedBigInteger('views')->default(0);

            // Waktu publish, bisa dijadwalkan (scheduled publish)
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes(); // agar konten tidak benar-benar hilang saat dihapus admin

            // --- Indexes ---
            // Query paling umum: WHERE status = 'published' AND published_at <= NOW()
            $table->index(['status', 'published_at']);

            // Untuk filter featured di homepage
            $table->index(['is_featured', 'status']);

            // Untuk filter per kategori
            $table->index(['kategori_id', 'status']);

            // Full-text search untuk fitur pencarian berita
            $table->fullText(['judul', 'ringkasan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
