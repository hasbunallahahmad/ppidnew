<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert new footer section menu locations
        $now = now();
        DB::table('fmm_menu_locations')->insertOrIgnore([
            [
                'handle' => 'footer_section_1',
                'name' => 'Footer - Layanan Kearsipan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'handle' => 'footer_section_2',
                'name' => 'Footer - Layanan Perpustakaan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'handle' => 'footer_section_3',
                'name' => 'Footer - Link Tambahan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the footer section menu locations
        DB::table('fmm_menu_locations')
            ->whereIn('handle', ['footer_section_1', 'footer_section_2', 'footer_section_3'])
            ->delete();
    }
};
