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
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();

            $table->string('nama', 100);

            // Slug unik untuk URL-friendly identifier
            $table->string('slug', 120)->unique();

            // Tipe menentukan kategori ini dipakai untuk konten apa
            // berita|dokumen|infografis|layanan
            $table->string('tipe', 30);

            // Warna untuk badge/pill di frontend & admin
            // blue|green|orange|teal|red|purple|gray|yellow
            $table->string('warna', 20)->default('blue');

            // Font Awesome icon class, contoh: 'fas fa-newspaper'
            $table->string('icon', 60)->nullable();

            // Deskripsi singkat opsional
            $table->string('deskripsi', 255)->nullable();

            $table->boolean('is_active')->default(true);

            // Urutan tampil di dropdown/list admin
            $table->unsignedSmallInteger('urutan')->default(0);

            $table->timestamps();

            // Index untuk filter berdasarkan tipe (paling sering dipakai)
            $table->index('tipe');
            $table->index(['tipe', 'is_active']);
            $table->index('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
