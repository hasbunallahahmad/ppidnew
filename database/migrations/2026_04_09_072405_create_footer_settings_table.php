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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // Brand & Description
            $table->string('brand_name')->nullable();
            $table->text('tagline')->nullable();

            // Social Media Links
            $table->string('social_facebook')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_twitter')->nullable();

            // Certificates/Badges
            $table->string('cert_1_text')->nullable();
            $table->string('cert_1_icon')->nullable();
            $table->string('cert_2_text')->nullable();
            $table->string('cert_2_icon')->nullable();

            // Contact Information
            $table->string('contact_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_hours')->nullable();

            // Footer Sections (stored as JSON for flexibility)
            $table->json('section_1_menu')->nullable(); // Layanan Kearsipan
            $table->json('section_2_menu')->nullable(); // Layanan Perpustakaan
            $table->json('section_3_menu')->nullable(); // Footer links (Privacy, Terms, etc)

            // Footer bottom text
            $table->text('footer_copyright')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
