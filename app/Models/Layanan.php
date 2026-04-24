<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Layanan extends Model
{
    use LogsActivity;

    protected $fillable = [
        'judul',
        'deskripsi',
        'icon',
        'warna',
        'url',
        'jumlah_label',
        'is_active',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // =========================================================
    // Spatie Activitylog
    // =========================================================

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'is_active', 'urutan', 'jumlah_label'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('layanan');
    }

    // =========================================================
    // Scopes
    // =========================================================

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('urutan');
    }

    // =========================================================
    // Helpers
    // =========================================================

    /**
     * CSS class untuk card layanan di frontend.
     * Contoh: layanan-blue, layanan-green, dst.
     */
    public function getCardClassAttribute(): string
    {
        return "layanan-{$this->warna}";
    }
}
