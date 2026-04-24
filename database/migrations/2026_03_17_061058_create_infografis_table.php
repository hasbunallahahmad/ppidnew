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
        Schema::create('infografis', function (Blueprint $table) {
            $table->id();

            $table->string('judul', 255);
            $table->string('slug', 280)->unique();

            // Font Awesome icon untuk fallback jika tidak ada thumbnail
            $table->string('icon', 60)->nullable();

            // Warna tema card: blue|green|orange|teal|red|purple
            $table->string('warna', 20)->default('blue');

            // Deskripsi singkat opsional
            $table->text('deskripsi')->nullable();

            // URL detail/download infografis
            $table->string('url_detail', 255)->default('#');

            // Counter views
            $table->unsignedBigInteger('views')->default(0);

            // Flag untuk tampil di widget infografis homepage
            $table->boolean('is_featured')->default(false);

            $table->boolean('is_active')->default(true);

            // Tanggal publikasi infografis (bisa berbeda dari created_at)
            $table->date('tanggal_publikasi')->nullable();

            // Urutan tampil (drag & drop di Filament)
            $table->unsignedSmallInteger('urutan')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // --- Indexes ---
            // Query homepage: WHERE is_featured = 1 AND is_active = 1 ORDER BY urutan
            $table->index(['is_featured', 'is_active', 'urutan']);

            // Filter tanggal untuk arsip infografis
            $table->index('tanggal_publikasi');

            // Full-text search
            $table->fullText(['judul', 'deskripsi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infografis');
    }
};
