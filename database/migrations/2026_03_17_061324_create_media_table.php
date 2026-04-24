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
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            // Polymorphic relation ke model apapun (Berita, Dokumen, Infografis, dll)
            $table->morphs('model'); // membuat model_type (string) + model_id (unsignedBigInt) + index otomatis

            // UUID unik per file untuk generate URL yang tidak predictable
            $table->uuid('uuid')->unique();

            // Nama koleksi media, contoh: 'thumbnail', 'dokumen_file', 'infografis_image'
            $table->string('collection_name');

            // Nama file asli saat upload
            $table->string('name');

            // Nama file yang disimpan di disk (bisa berbeda dari name)
            $table->string('file_name');

            // MIME type: image/jpeg, application/pdf, dll
            $table->string('mime_type')->nullable();

            // Disk Laravel yang dipakai: public, s3, dll (dari config filesystems)
            $table->string('disk');

            // Disk untuk conversions (thumbnail, resize) — bisa berbeda dari disk utama
            $table->string('conversions_disk')->nullable();

            // Ukuran file dalam bytes
            $table->unsignedBigInteger('size');

            // Metadata tambahan dalam JSON: width, height, EXIF, dll
            $table->json('manipulations');

            // Custom properties yang bisa diset saat upload
            $table->json('custom_properties');

            // Daftar conversions yang sudah digenerate (untuk responsive images)
            $table->json('generated_conversions');

            // Responsive image info
            $table->json('responsive_images');

            // Urutan dalam koleksi (untuk multiple files)
            $table->unsignedInteger('order_column')->nullable();

            $table->nullableTimestamps();

            // --- Indexes ---
            // Spatie sudah tambahkan index via morphs(), tapi tambahkan composite
            // untuk query: WHERE model_type = ? AND model_id = ? AND collection_name = ?
            $table->index(['model_type', 'model_id', 'collection_name'], 'media_model_collection_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
