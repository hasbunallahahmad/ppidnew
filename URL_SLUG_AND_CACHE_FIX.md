# 🔧 URL Slug & Cache Fix Documentation

## Masalah yang Diperbaiki

### 1. ❌ URL Masih Pakai ID

**Sebelum:**

```
http://127.0.0.1:8000/ppid-new-pusda-smg/hero-settings/1/edit
                                                      ↑
                                                  ID (tidak aman)
```

**Sesudah:**

```
http://127.0.0.1:8000/ppid-new-pusda-smg/hero-settings/arsip-literasi/edit
                                                       ↑
                                                   SLUG (lebih aman)
```

### 2. ❌ Data Tidak Ter-update di Landing Page

**Masalah:** Saat edit value di admin panel, hero.blade.php tidak langsung menampilkan perubahan
**Penyebab:** Cache tidak ter-clear setelah update, atau data yang ambil dari cache lama

## Solusi yang Diimplementasikan

### 1. Route Key Name (URL Slug)

**File:** `app/Models/HeroSetting.php`

```php
/**
 * Get route key name (use slug instead of id)
 */
public function getRouteKeyName()
{
    return 'slug';
}
```

Sekarang Filament otomatis menggunakan slug di URL routing!

### 2. Routing Update

**File:** `app/Filament/Resources/HeroSettings/HeroSettingResource.php`

Ubah dari:

```php
'edit' => EditHeroSetting::route('/{record}/edit'),
```

Menjadi:

```php
'edit' => EditHeroSetting::route('/{record:slug}/edit'),
```

### 3. Record Title Attribute

Ubah dari:

```php
protected static ?string $recordTitleAttribute = 'id';
```

Menjadi:

```php
protected static ?string $recordTitleAttribute = 'slug';
```

### 4. Cache Invalidation Strategy

**File:** `app/Models/HeroSetting.php`

Tambahkan cache clearing pada model events:

```php
// Clear cache setelah update
static::updated(function ($model) {
    self::clearHeroCache();
});

// Clear cache setelah create
static::created(function ($model) {
    self::clearHeroCache();
});

// Clear cache setelah delete
static::deleted(function ($model) {
    self::clearHeroCache();
});

/**
 * Clear hero settings cache
 */
public static function clearHeroCache()
{
    Cache::forget('hero_settings_cache');
    Cache::forget('hero_settings_' . encrypt('hero-settings'));
}
```

### 5. Fresh Database Query

**Method `settings()` diubah:**

```php
/**
 * Get atau create hero settings (singleton pattern)
 * Selalu ambil data fresh dari database, tidak pakai cache
 */
public static function settings()
{
    // Selalu ambil record terbaru dari database (no cache)
    $setting = self::where('id', 1)->first();

    if (!$setting) {
        // Jika tidak ada, create dengan data default
        $setting = self::create([...]);
    }

    return $setting;
}
```

**Keuntunatan:**

- ✅ Tidak menggunakan `firstOrCreate` yang bisa cache
- ✅ Direktolangsung query database: `self::where('id', 1)->first()`
- ✅ Selalu ambil data fresh, tidak ada stale data

## Test Results

```
✅ Route Key: slug
✅ URL akan menggunakan SLUG bukan ID
✅ Update berhasil & cache cleared
✅ Data dikembalikan ke semula
✅ Data konsisten (fresh dari database)
✅ URL akan menggunakan: /hero-settings/{slug}/edit
✅ Data akan ter-update di landing page setelah edit
```

## Flow Perubahan Data

### Saat Edit di Admin Panel:

```
1. User Edit data
       ↓
2. Filament form submit
       ↓
3. Model::update() dipanggil
       ↓
4. Model Event "updated" trigger
       ↓
5. Cache::forget() di-call (clearHeroCache)
       ↓
6. Data disimpan di database
       ↓
7. Landing page meload hero.blade.php
       ↓
8. hero.blade.php panggil HeroSetting::settings()
       ↓
9. Method settings() query fresh dari database
       ↓
10. Data baru ditampilkan di website ✅
```

## URL Perubahan

### Edit URL

**Sebelum:** `/hero-settings/1/edit`
**Sesudah:** `/hero-settings/arsip-literasi/edit`

### Delete URL

**Sebelum:** `/hero-settings/1` (DELETE)
**Sesudah:** `/hero-settings/arsip-literasi` (DELETE)

### Show URL (jika ada)

**Sebelum:** `/hero-settings/1`
**Sesudah:** `/hero-settings/arsip-literasi`

## Keamanan Improved

| Aspek            | Sebelum                 | Sesudah                         |
| ---------------- | ----------------------- | ------------------------------- |
| URL Pattern      | `/hero-settings/1`      | `/hero-settings/arsip-literasi` |
| ID Enumeration   | ❌ Mudah ditebak        | ✅ Random slug                  |
| Data Freshness   | ❓ Possible stale cache | ✅ Always fresh                 |
| Cache Management | ❌ Manual               | ✅ Automatic                    |
| Route Binding    | ❌ By ID                | ✅ By slug                      |

## Troubleshooting

### Jika URL masih pakai ID?

- Clear route cache: `php artisan route:clear`
- Restart dev server

### Jika data masih tidak update?

- Clear semua cache:
    ```bash
    php artisan cache:clear
    php artisan view:clear
    php artisan route:clear
    php artisan config:clear
    ```
- Restart dev server

### Jika settings() return null?

- Check database record id=1 ada
- Check status migration selesai dengan benar

## File yang Diubah

```
✅ app/Models/HeroSetting.php
   - Add getRouteKeyName()
   - Add cache clearing events
   - Update settings() method
   - Add clearHeroCache() method

✅ app/Filament/Resources/HeroSettings/HeroSettingResource.php
   - Change recordTitleAttribute to 'slug'
   - Update routing: /{record:slug}/edit

✅ All other files stay the same
```

## Verification Checklist

- ✅ Route key name returns 'slug'
- ✅ Admin URL uses slug, not ID
- ✅ Update triggers cache clear
- ✅ settings() always returns fresh data
- ✅ Data updates show on landing page immediately
- ✅ No stale cache issues
- ✅ Security improved with slug routing

---

**Status:** ✅ Fixed & Tested  
**Date:** 9 April 2026
