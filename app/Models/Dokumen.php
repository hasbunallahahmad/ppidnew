<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Dokumen extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasSlug;
    use LogsActivity;

    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'deskripsi',
        'tipe_informasi',
        'tahun',
        'nama_file_original',
        'ukuran_file',
        'mime_type',
        'is_active',
        'downloads',
    ];

    protected function casts(): array
    {
        return [
            'is_active'   => 'boolean',
            'downloads'   => 'integer',
            'ukuran_file' => 'integer',
        ];
    }

    // =========================================================
    // Spatie Sluggable
    // =========================================================

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(300)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // =========================================================
    // Spatie Media Library
    // =========================================================

    public function registerMediaCollections(): void
    {
        // Koleksi untuk file dokumen utama (PDF, DOCX, XLSX, dst)
        $this->addMediaCollection('file_dokumen')
            ->singleFile()
            ->acceptsMimeTypes([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ])
            ->useDisk('public');

        // Koleksi opsional untuk thumbnail/cover image dokumen
        $this->addMediaCollection('cover')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');
    }

    // =========================================================
    // Spatie Activitylog
    // =========================================================

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'tipe_informasi', 'is_active', 'kategori_id', 'tahun'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('dokumen');
    }

    // =========================================================
    // Scopes
    // =========================================================

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Filter berdasarkan tipe informasi UU KIP.
     * Contoh: Dokumen::tipe('berkala')->count()
     */
    public function scopeTipe(Builder $query, string $tipe): Builder
    {
        return $query->where('tipe_informasi', $tipe);
    }

    public function scopeByTahun(Builder $query, int $tahun): Builder
    {
        return $query->where('tahun', $tahun);
    }

    // =========================================================
    // Relationships
    // =========================================================

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    // =========================================================
    // Helpers
    // =========================================================

    /**
     * Increment download counter tanpa trigger timestamps/observer.
     */
    public function incrementDownloads(): void
    {
        $this->timestamps = false;
        $this->increment('downloads');
        $this->timestamps = true;
    }

    /**
     * URL file untuk download, null jika belum ada file.
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('file_dokumen') ?: null;
    }

    /**
     * Ukuran file dalam format human-readable.
     * Contoh: "2.4 MB", "340 KB"
     */
    public function getUkuranFileReadableAttribute(): ?string
    {
        if (! $this->ukuran_file) {
            return null;
        }

        $bytes = $this->ukuran_file;

        if ($bytes >= 1_048_576) {
            return round($bytes / 1_048_576, 1) . ' MB';
        }

        if ($bytes >= 1_024) {
            return round($bytes / 1_024, 0) . ' KB';
        }

        return $bytes . ' B';
    }

    /**
     * Label human-readable untuk tipe_informasi.
     */
    public function getTipeInformasiLabelAttribute(): string
    {
        return match ($this->tipe_informasi) {
            'berkala'      => 'Informasi Berkala',
            'setiap_saat'  => 'Informasi Setiap Saat',
            'serta_merta'  => 'Informasi Serta Merta',
            'dikecualikan' => 'Informasi Dikecualikan',
            default        => $this->tipe_informasi,
        };
    }

    /**
     * Warna badge untuk tipe informasi di frontend.
     */
    public function getTipeInformasiWarnaAttribute(): string
    {
        return match ($this->tipe_informasi) {
            'berkala'      => 'blue',
            'setiap_saat'  => 'green',
            'serta_merta'  => 'orange',
            'dikecualikan' => 'gray',
            default        => 'blue',
        };
    }
}
