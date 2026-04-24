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
        Schema::create('statistik_kunjungans', function (Blueprint $table) {
            $table->id();

            // Nama bulan/periode untuk label di chart, contoh: "Juli 2024"
            $table->string('nama', 50);

            // Jumlah kunjungan
            $table->unsignedInteger('jumlah');

            // Identifier periode untuk filter/group, contoh: "semester_2_2024"
            // Dipakai scope periodeAktif() untuk ambil satu set data chart
            $table->string('periode', 50);

            // Label human-readable untuk heading statistik
            // Contoh: "Kunjungan Perpustakaan Semester II 2024"
            $table->string('keterangan_periode', 150)->nullable();

            // Catatan tambahan opsional
            $table->string('catatan', 255)->nullable();

            // Urutan tampil di bar chart (biasanya urutan bulan)
            $table->unsignedSmallInteger('urutan')->default(0);

            $table->timestamps();

            // --- Indexes ---
            // Query utama: WHERE periode = ? ORDER BY urutan
            $table->index(['periode', 'urutan']);

            // Unique agar tidak duplikat entri per nama dalam satu periode
            $table->unique(['periode', 'nama']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_kunjungans');
    }
};
