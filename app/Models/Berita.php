<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Berita extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasSlug;
    use LogsActivity;

    protected $fillable = [
        'kategori_id',
        'user_id',
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'status',
        'is_featured',
        'views',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_featured'  => 'boolean',
            'published_at' => 'datetime',
            'views'        => 'integer',
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
            ->doNotGenerateSlugsOnUpdate(); // slug tidak berubah jika judul diedit
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
            ->singleFile()                                    // hanya 1 thumbnail per berita
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // Otomatis generate versi kecil untuk card list (240x160)
        $this->addMediaConversion('thumb')
            ->width(480)
            ->height(320)
            ->sharpen(5)
            ->nonQueued();

        // Versi medium untuk featured section (800x533)
        $this->addMediaConversion('medium')
            ->width(800)
            ->height(533)
            ->nonQueued();
    }

    // =========================================================
    // Spatie Activitylog
    // =========================================================

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'status', 'is_featured', 'kategori_id', 'published_at'])
            ->logOnlyDirty()           // hanya catat kolom yang benar-benar berubah
            ->dontSubmitEmptyLogs()    // jangan log jika tidak ada perubahan
            ->useLogName('berita');
    }

    // =========================================================
    // Scopes
    // =========================================================

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query->published()->orderByDesc('published_at');
    }

    public function scopeByKategori(Builder $query, int|string $kategori): Builder
    {
        if (is_numeric($kategori)) {
            return $query->where('kategori_id', $kategori);
        }

        return $query->whereHas('kategori', fn($q) => $q->where('slug', $kategori));
    }

    // =========================================================
    // Relationships
    // =========================================================

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // =========================================================
    // Helpers
    // =========================================================

    /**
     * Increment views counter — dipanggil di controller show().
     * Pakai increment() langsung ke DB agar tidak trigger observer/event.
     */
    public function incrementViews(): void
    {
        $this->timestamps = false;              // jangan update updated_at
        $this->increment('views');
        $this->timestamps = true;
    }

    /**
     * Apakah berita ini sudah terpublish dan bisa dilihat publik.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && $this->published_at->lte(now());
    }

    /**
     * URL thumbnail untuk card, fallback ke null jika belum ada media.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('thumbnail', 'thumb') ?: null;
    }

    /**
     * URL thumbnail medium untuk featured section.
     */
    public function getThumbnailMediumUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('thumbnail', 'medium') ?: null;
    }
}
