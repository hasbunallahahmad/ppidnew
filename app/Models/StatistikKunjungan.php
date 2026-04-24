<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class StatistikKunjungan extends Model
{
    use LogsActivity;

    protected $table = 'statistik_kunjungans';

    protected $fillable = [
        'nama',
        'jumlah',
        'periode',
        'keterangan_periode',
        'catatan',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
        ];
    }
    public function toViewData(): array
    {
        return [
            'nama'              => $this->nama,
            'jumlah'            => $this->jumlah,
            'periode'           => $this->periode,
            'keterangan_periode' => $this->keterangan_periode,
        ];
    }
    // =========================================================
    // Spatie Activitylog
    // =========================================================

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama', 'jumlah', 'periode'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('statistik');
    }

    // =========================================================
    // Scopes
    // =========================================================

    /**
     * Ambil data kunjungan untuk periode yang sedang aktif.
     * Periode aktif diambil dari site_settings key 'statpus_periode_aktif'.
     *
     * Contoh: StatistikKunjungan::periodeAktif()->ordered()->get()
     */
    public function scopePeriodeAktif(Builder $query): Builder
    {
        $periodeAktif = SiteSetting::get('statpus_periode_aktif', 'semester_2_2024');

        return $query->where('periode', $periodeAktif);
    }

    /**
     * Filter manual berdasarkan kode periode tertentu.
     * Contoh: StatistikKunjungan::periode('semester_1_2025')->get()
     */
    public function scopePeriode(Builder $query, string $periode): Builder
    {
        return $query->where('periode', $periode);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('urutan');
    }

    // =========================================================
    // Helpers
    // =========================================================

    /**
     * Hitung persentase relatif terhadap nilai tertinggi dalam periode yang sama.
     * Dipakai untuk lebar bar chart di frontend.
     *
     * Contoh: $item->pct → 87 (berarti bar lebarnya 87%)
     */
    public function getPctAttribute(): int
    {
        $maxJumlah = static::where('periode', $this->periode)->max('jumlah');

        if (! $maxJumlah || $maxJumlah === 0) {
            return 0;
        }

        return (int) round(($this->jumlah / $maxJumlah) * 100);
    }
}
