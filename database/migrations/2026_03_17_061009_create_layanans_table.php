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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();

            $table->string('judul', 150);

            // Deskripsi pendek untuk card layanan di homepage
            $table->text('deskripsi');

            // Font Awesome class, contoh: 'fas fa-newspaper'
            $table->string('icon', 60);

            // Warna tema card: blue|green|orange|teal|red|purple
            $table->string('warna', 20)->default('blue');

            // URL tujuan tombol "Lihat Semua"
            $table->string('url', 255)->default('#');

            // Label jumlah konten dinamis, contoh: "248 artikel", "156 dataset"
            // Bisa diupdate manual atau via observer dari tabel terkait
            $table->string('jumlah_label', 50)->nullable();

            $table->boolean('is_active')->default(true);

            // Urutan tampil di grid homepage (drag & drop di Filament)
            $table->unsignedSmallInteger('urutan')->default(0);

            $table->timestamps();

            // Index untuk query homepage: WHERE is_active = 1 ORDER BY urutan
            $table->index(['is_active', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
