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
        Schema::create('statistik_kearsipan', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->default('Rekapitulasi Arsip');
            $table->string('diperbarui')->nullable();
            $table->unsignedBigInteger('arsip_aktif')->default(0);
            $table->unsignedBigInteger('arsip_inaktif')->default(0);
            $table->unsignedBigInteger('arsip_statis')->default(0);
            $table->unsignedBigInteger('arsip_vital')->default(0);
            $table->unsignedBigInteger('arsip_digital')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_kearsipan');
    }
};
