# 🔗 Dokumentasi Koneksi Hero Settings - Admin Panel ke Landing Page

## Flow Diagram

```
┌─────────────────────┐
│   Admin Panel       │
│   (Filament)        │
└──────────┬──────────┘
           │
           │ Input data melalui Form
           │ (Title, Description, Stats, Buttons)
           ↓
┌─────────────────────┐
│   Database          │
│  (hero_settings)    │
│  id=1, title, desc..│
└──────────┬──────────┘
           │
           │ Retrieve data via Model
           │ HeroSetting::settings()
           ↓
┌─────────────────────┐
│   Blade Template    │
│  (hero.blade.php)   │
│  Display data       │
└──────────┬──────────┘
           │
           ↓
┌─────────────────────┐
│  Landing Page       │
│  (Public Website)   │
│  Displayed to Users │
└─────────────────────┘
```

## 📝 Cara Kerja Koneksi

### 1. **Admin Input Data**

User membuka `/admin` → Menu "Pengaturan Hero" → Edit Form → Simpan

Contoh:

- **Judul Utama**: "Arsip & Literasi"
- **Judul Highlight**: "untuk Semarang"
- **Deskripsi**: "Portal informasi publik..."
- **Statistik 1**: "8.240" / "Arsip Digital"
- **Tombol 1**: "Ajukan Permohonan" / "#permohonan"

### 2. **Data Tersimpan di Database**

Filament Resource otomatis menyimpan data ke tabel `hero_settings`:

```sql
UPDATE hero_settings
SET
  title = 'Arsip & Literasi',
  title_accent = 'untuk Semarang',
  description = 'Portal informasi publik...',
  stat_1_value = '8.240',
  stat_1_label = 'Arsip Digital',
  button_1_text = 'Ajukan Permohonan',
  button_1_url = '#permohonan',
  ... (field lainnya)
WHERE id = 1;
```

### 3. **Landing Page Mengambil Data**

File `resources/views/components/hero.blade.php`:

```blade
@php
    // Ambil data dari database
    $heroSetting = \App\Models\HeroSetting::settings();
@endphp

<h1>{{ $heroSetting->title }}<br>
    <span>{{ $heroSetting->title_accent }}</span>
</h1>

<p>{{ $heroSetting->description }}</p>

<div class="hero-stats">
    <div>
        <strong>{{ $heroSetting->stat_1_value }}</strong>
        <span>{{ $heroSetting->stat_1_label }}</span>
    </div>
</div>
```

### 4. **User Melihat Perubahan di Website**

Ketika user membuka landing page, mereka akan melihat data yang telah diperbarui di admin panel.

## 🔄 Model: Singleton Pattern

Model `HeroSetting` menggunakan **Singleton Pattern**:

```php
public static function settings()
{
    return self::firstOrCreate(
        ['id' => 1],  // Cari record dengan id=1
        [/* default data */]  // Jika tidak ada, buat baru
    );
}
```

**Keuntungan:**

- ✅ Hanya ada 1 record hero settings
- ✅ Tidak perlu worry tentang ID
- ✅ Lebih simple dan predictable
- ✅ Dapat diakses dari mana saja

## 📊 Field Mapping: Admin Form → Blade Template

| Admin Form Field | Database Column   | Blade Template Usage                      |
| ---------------- | ----------------- | ----------------------------------------- |
| Judul Utama      | `title`           | `{{ $heroSetting->title }}`               |
| Judul Highlight  | `title_accent`    | `{{ $heroSetting->title_accent }}`        |
| Deskripsi        | `description`     | `{{ $heroSetting->description }}`         |
| Stat 1 Nilai     | `stat_1_value`    | `{{ $heroSetting->stat_1_value }}`        |
| Stat 1 Label     | `stat_1_label`    | `{{ $heroSetting->stat_1_label }}`        |
| Stat 2 Nilai     | `stat_2_value`    | `{{ $heroSetting->stat_2_value }}`        |
| Stat 2 Label     | `stat_2_label`    | `{{ $heroSetting->stat_2_label }}`        |
| Stat 3 Nilai     | `stat_3_value`    | `{{ $heroSetting->stat_3_value }}`        |
| Stat 3 Label     | `stat_3_label`    | `{{ $heroSetting->stat_3_label }}`        |
| Tombol 1 Teks    | `button_1_text`   | `{{ $heroSetting->button_1_text }}`       |
| Tombol 1 URL     | `button_1_url`    | `href="{{ $heroSetting->button_1_url }}"` |
| Tombol 2 Teks    | `button_2_text`   | `{{ $heroSetting->button_2_text }}`       |
| Tombol 2 URL     | `button_2_url`    | `href="{{ $heroSetting->button_2_url }}"` |
| Tombol 2 Anchor  | `button_2_anchor` | (untuk internal reference)                |

## 🧪 Testing & Verification

Koneksi sudah ditest dan 100% berfungsi! ✅

Hasil test:

- ✅ Data dapat diambil dari database
- ✅ Semua 15 field tersimpan dengan benar
- ✅ Update data berfungsi dengan sempurna
- ✅ Data langsung reflect ke template

## 💡 Contoh Penggunaan

### Mengubah Judul Hero

1. Buka `/admin`
2. Klik "Pengaturan Hero"
3. Edit field "Judul Utama" dari "Arsip & Literasi" menjadi "Informasi Publik Semarang"
4. Klik "Simpan"
5. Buka landing page → Judul sudah berubah! ✨

### Mengubah Statistik

1. Edit "Statistik 1 - Nilai" dari "8.240" menjadi "10.000"
2. Edit "Statistik 1 - Label" dari "Arsip Digital" menjadi "Dokumen Aktif"
3. Simpan
4. Landing page akan menampilkan: **10.000** Dokumen Aktif

### Mengubah Tombol

1. Edit "Tombol 2 - URL" dari "#layanan" menjadi "/services"
2. Simpan
3. Klik tombol di landing page → akan redirect ke `/services`

## 🚀 File-File Terlibat

```
├── app/Models/HeroSetting.php
│   └── Method: settings() - Singleton accessor
│
├── app/Filament/Resources/HeroSettings/
│   ├── HeroSettingResource.php - Resource utama
│   ├── Schemas/HeroSettingForm.php - Form input dengan 3 section
│   ├── Tables/HeroSettingsTable.php - Tabel management
│   └── Pages/
│       ├── ListHeroSettings.php
│       ├── CreateHeroSetting.php
│       └── EditHeroSetting.php
│
├── resources/views/components/hero.blade.php
│   └── Template yang menampilkan data dinamis
│
└── database/migrations/2026_04_09_054331_create_hero_settings_table.php
    └── Struktur tabel hero_settings
```

## 📋 Checklist Setup Lengkap

- ✅ Migration sudah dijalankan
- ✅ Tabel `hero_settings` sudah dibuat
- ✅ Model `HeroSetting` sudah siap dengan singleton method
- ✅ Filament Resource sudah terbuat dengan form lengkap (3 section)
- ✅ Blade template sudah update menggunakan data dinamis
- ✅ Koneksi admin → database → landing page sudah tested
- ✅ Data default sudah di-setup

## ⚠️ Important Notes

1. **Jangan hapus record dengan id=1** - Singleton pattern depend pada record ini
2. **Clear cache jika ada masalah**: `php artisan cache:clear`
3. **Tidak perlu restart app** - Filament otomatis save ke database
4. **Perubahan langsung terlihat** - Tidak perlu deploy ulang

---

**Status**: ✅ Fully Connected & Tested  
**Last Updated**: 9 April 2026
