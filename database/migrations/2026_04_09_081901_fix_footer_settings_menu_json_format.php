<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix corrupted JSON data in footer_settings menu fields
        // This handles cases where empty strings or invalid JSON were stored
        $records = DB::table('footer_settings')->get();

        foreach ($records as $record) {
            $updates = [];

            // Check and fix each menu field
            foreach (['section_1_menu', 'section_2_menu', 'section_3_menu'] as $field) {
                $value = $record->{$field};

                // If it's a string but not valid JSON, or if it's an empty string, convert to empty array
                if (is_string($value)) {
                    if (empty($value) || $value === '""' || !$this->isValidJson($value)) {
                        $updates[$field] = json_encode([]);
                    }
                    // If it's a valid JSON string, it's already fine
                }
                // If it's null, leave it as is (will be handled by model casts)
            }

            // Update the record if any fields need fixing
            if (!empty($updates)) {
                DB::table('footer_settings')
                    ->where('id', $record->id)
                    ->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // There's no safe way to reverse this migration
        // It only fixes corrupted data
    }

    /**
     * Check if a string is valid JSON
     */
    private function isValidJson($string): bool
    {
        if (!is_string($string)) {
            return false;
        }
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
};
