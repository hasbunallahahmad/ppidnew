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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();

            // Nama log group, contoh: 'berita', 'dokumen', 'default'
            $table->string('log_name')->nullable();

            // Deskripsi aksi: 'created', 'updated', 'deleted'
            $table->text('description');

            // Subject: model yang diaksi (Berita, Dokumen, dll) — polymorphic
            $table->nullableMorphs('subject');

            // Event yang terjadi (untuk filter di dashboard)
            $table->string('event')->nullable();

            // Causer: user yang melakukan aksi — polymorphic
            $table->nullableMorphs('causer');

            // Data perubahan dalam JSON: ['old' => [...], 'new' => [...]]
            $table->json('properties')->nullable();

            // Batch UUID untuk mengelompokkan beberapa aksi dalam satu request
            $table->uuid('batch_uuid')->nullable();

            $table->timestamps();

            // --- Indexes ---
            // CATATAN: nullableMorphs('subject') dan nullableMorphs('causer') di atas
            // sudah otomatis membuat index untuk (subject_type, subject_id) dan
            // (causer_type, causer_id) — JANGAN tambahkan index manual untuk keduanya
            // atau akan terjadi "Duplicate key name" error saat migrate.

            $table->index('log_name');
            $table->index('event');

            // Untuk cleanup log lama berdasarkan tanggal
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
