<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Infografis extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasSlug;
    use LogsActivity;

    protected $fillable = [
        'judul',
        'slug',
        'icon',
        'warna',
        'deskripsi',
        'url_detail',
        'views',
        'is_featured',
        'is_active',
        'tanggal_publikasi',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'views'             => 'integer',
            'tanggal_publikasi' => 'date',
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
            ->slugsShouldBeNoLongerThan(260)
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
        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');

        // File infografis full resolution untuk download
        $this->addMediaCollection('file_infografis')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'application/pdf'])
            ->useDisk('public');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // Thumbnail kecil untuk grid homepage
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->sharpen(5)
            ->performOnCollections('thumbnail')
            ->nonQueued();
    }

    // =========================================================
    // Spatie Activitylog
    // =========================================================

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'is_featured', 'is_active', 'urutan'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('infografis');
    }

    // =========================================================
    // Scopes
    // =========================================================

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('urutan')->orderByDesc('tanggal_publikasi');
    }

    // =========================================================
    // Helpers
    // =========================================================

    public function incrementViews(): void
    {
        $this->timestamps = false;
        $this->increment('views');
        $this->timestamps = true;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('thumbnail', 'thumb') ?: null;
    }

    /**
     * Tanggal publikasi dalam format Indonesia.
     * Contoh: "10 Maret 2025"
     */
    public function getTanggalFormatAttribute(): ?string
    {
        return $this->tanggal_publikasi?->translatedFormat('d F Y');
    }
}
