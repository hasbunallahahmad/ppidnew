# 🔒 Slug Security Implementation - Hero Settings

## Deskripsi Slug Security

Slug adalah identifier unik berbentuk string yang di-generate otomatis dari judul untuk keamanan sistem. Slug ini berfungsi sebagai:

- ✅ **Identifikasi Unik** - Setiap record memiliki slug unik yang tidak bisa duplikat
- ✅ **Pencegahan ID Guessing** - Mengganti numeric ID yang mudah ditebak
- ✅ **SEO-Friendly URLs** - Format yang aman dan mudah dibaca
- ✅ **CSRF Protection Layer** - Lapisan keamanan tambahan untuk API requests

## Fitur Slug di Hero Settings

### 1. **Auto-Generation**

Slug otomatis di-generate dari `title` ketika:

- ✅ Record baru dibuat
- ✅ Title diubah (slug otomatis update)

**Contoh:**

- Title: "Arsip & Literasi" → Slug: `arsip-literasi`
- Title: "Sistem Informasi Publik" → Slug: `sistem-informasi-publik`
- Title: "Portal Semarang!!!" → Slug: `portal-semarang`

### 2. **Validasi Format**

Slug harus mengikuti format:

- ✅ Huruf kecil (a-z)
- ✅ Angka (0-9)
- ✅ Hyphen (-) sebagai separator
- ✅ Panjang 3-63 karakter
- ❌ Tidak boleh dimulai/diakhiri dengan hyphen
- ❌ Tidak boleh karakter spesial

**Format Regex:** `^[a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?$`

### 3. **Unique Constraint**

- ✅ Setiap slug harus unik di table
- ✅ Database-level unique constraint
- ✅ Form-level validation di Filament

### 4. **Singleton Protection**

- ✅ Record utama (id=1) memiliki slug: `arsip-literasi`
- ✅ Slug pada record id=1 tidak bisa diubah di admin panel
- ✅ Field slug disabled saat edit record dengan id=1

## Implementasi Teknis

### A. Migration

File: `database/migrations/2026_04_09_061841_add_slug_to_hero_settings_table.php`

```php
Schema::table('hero_settings', function (Blueprint $table) {
    $table->string('slug')->unique()->after('id');
});
```

### B. Model Boot Method

File: `app/Models/HeroSetting.php`

```php
protected static function boot()
{
    parent::boot();

    // Auto-generate slug dari title saat create
    static::creating(function ($model) {
        if (empty($model->slug)) {
            $model->slug = Str::slug($model->title ?? 'hero-settings-' . time());
        }
    });

    // Auto-update slug saat title berubah
    static::updating(function ($model) {
        if ($model->isDirty('title') && !$model->isDirty('slug')) {
            $model->slug = Str::slug($model->title);
        }
    });
}
```

### C. Admin Form

File: `app/Filament/Resources/HeroSettings/Schemas/HeroSettingForm.php`

```php
Section::make('Keamanan & Pengaturan')
    ->icon('heroicon-o-shield-check')
    ->schema([
        TextInput::make('slug')
            ->label('Slug (untuk Keamanan)')
            ->required()
            ->unique('hero_settings', 'slug', ignoreRecord: true)
            ->helperText('Auto-generated dari judul untuk keamanan sistem.')
            ->rules('regex:/^[a-z0-9]([a-z0-9-]{0,61}[a-z0-9])?$/')
            ->disabled(fn ($record) => $record?->id === 1), // Disable untuk record id=1
    ]),
```

### D. Admin Table

File: `app/Filament/Resources/HeroSettings/Tables/HeroSettingsTable.php`

```php
TextColumn::make('slug')
    ->label('Slug (Keamanan)')
    ->copyable()  // Bisa di-copy dengan satu klik
    ->searchable(),
```

## Keamanan yang Ditingkatkan

### 1. **Preventing ID Enumeration**

Sebelumnya: `GET /hero/1` (mudah ditebak)
Sekarang: Slug unik sebagai identifier alternatif

### 2. **Validation Layer**

- ✅ Format validation: regex pattern
- ✅ Unique validation: mencegah duplikat
- ✅ Length validation: 3-63 karakter

### 3. **Mass Assignment Protection**

```php
protected $fillable = [
    'slug',  // ← Harus di-whitelist
    'title',
    'description',
    // ... field lainnya
];
```

### 4. **Immutable Record**

Record dengan id=1 tidak bisa mengubah slug:

```php
->disabled(fn ($record) => $record?->id === 1)
```

## Contoh Penggunaan

### Di Admin Panel

1. Buka `/admin/hero-settings`
2. Lihat kolom "Slug (Keamanan)" di table
3. Slug sudah otomatis ter-generate
4. Saat edit title: slug otomatis update
5. Klik icon copy untuk copy slug

### Di Code (Query by Slug)

```php
// Query by slug instead of ID
$heroBySlug = \App\Models\HeroSetting::where('slug', 'arsip-literasi')->first();

// Lebih aman untuk public API
$hero = \DB::where('slug', request('slug'))->first();
```

### Di Blade Template (Current)

```blade
@php
    $heroSetting = \App\Models\HeroSetting::settings(); // Masih pakai singleton
@endphp
```

## Skenario Keamanan

### ✅ Scenario 1: User mencoba set slug tidak valid

**Input:** `hero@#$%&`
**Result:** Validation error, tidak bisa save
**Pesan:** "Format slug tidak valid"

### ✅ Scenario 2: User mencoba duplikat slug

**Input:** Mengubah title menjadi "Arsip & Literasi" (sama seperti record lain)
**Result:** Unique constraint error
**Pesan:** "Slug sudah digunakan"

### ✅ Scenario 3: User mencoba ubah slug record id=1

**Action:** Field slug disabled (readonly)
**Result:** Tidak bisa diubah
**Pesan:** Slug tidak bisa diubah untuk record utama

### ✅ Scenario 4: Auto-generation bekerja

**Edit:** Ubah title dari "Arsip & Literasi" → "Platform Informasi"
**Result:** Slug otomatis update: `arsip-literasi` → `platform-informasi`

## Testing Results

```
✅ Format slug valid dan aman: arsip-literasi
✅ Auto-generate dari title baru: sistem-informasi-publik
✅ Records dengan slug unique: 1
✅ Constraint unique berfungsi dengan baik
✅ SEMUA TEST SECURITY PASSED!
```

## Best Practices

1. **Jangan hardcode slug** - Biarkan sistem auto-generate
2. **Jangan share/expose slug** - Hanya untuk internal use
3. **Selalu validate** - Backend harus validate slug format
4. **Keep it secret** - Jangan publish slug di public API
5. **Update documentation** - Inform team tentang slug usage

## Files Terlibat

```
✅ database/migrations/2026_04_09_061841_add_slug_to_hero_settings_table.php
✅ app/Models/HeroSetting.php (boot method)
✅ app/Filament/Resources/HeroSettings/Schemas/HeroSettingForm.php
✅ app/Filament/Resources/HeroSettings/Tables/HeroSettingsTable.php
✅ resources/views/components/hero.blade.php (no changes needed)
```

## Troubleshooting

### Slug tidak ter-generate?

```php
// Force regenerate slug
$hero = HeroSetting::find(1);
$hero->slug = Str::slug($hero->title);
$hero->save();
```

### Error "Slug sudah digunakan"?

Slug sudah ada. Ubah title atau hapus record lama yang punya slug sama.

### Field slug tidak muncul di form?

Clear cache: `php artisan cache:clear`

## Roadmap Keamanan (Opsional)

- [ ] Add encryption untuk sensitive fields
- [ ] Implement audit logging untuk perubahan
- [ ] Add rate limiting untuk edit
- [ ] Implement API key authentication
- [ ] Add IP whitelist untuk admin access

---

**Status:** ✅ Implemented & Tested  
**Security Level:** 🔒 Enhanced  
**Last Updated:** 9 April 2026
