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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // Key unik sebagai identifier setting, contoh: 'hero_title', 'stat_informasi'
            $table->string('key', 100)->unique();

            // Value disimpan sebagai text agar fleksibel (string, JSON, angka, boolean)
            $table->text('value')->nullable();

            // Tipe membantu casting di aplikasi: text|json|boolean|integer|image
            $table->string('type', 20)->default('text');

            // Group untuk mengelompokkan settings di admin panel
            // Contoh: general|hero|footer|kontak|statistik
            $table->string('group', 50)->default('general');

            // Label human-readable untuk tampil di form admin
            $table->string('label', 150)->nullable();

            $table->timestamps();

            // Composite index: sering query WHERE group = ? untuk load semua settings satu group
            $table->index('group');
            $table->index(['group', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
