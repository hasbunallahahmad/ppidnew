# Panduan Hero Settings - Input Dinamis Melalui Filament Admin

## Deskripsi

Fitur Hero Settings memungkinkan Anda untuk mengelola semua konten di hero section (banner utama) website secara dinamis melalui admin panel Filament, tanpa perlu mengubah kode atau file template.

## Apa yang Telah Dibuat

### 1. **Database & Model**

- **File Migration**: `database/migrations/2026_04_09_054331_create_hero_settings_table.php`
- **Model**: `app/Models/HeroSetting.php`

Tabel `hero_settings` menyimpan data berikut:

- `title` - Judul utama hero
- `title_accent` - Bagian judul yang di-highlight
- `description` - Deskripsi/paragraf utama
- `stat_1_value`, `stat_1_label` - Statistik pertama (nilai & label)
- `stat_2_value`, `stat_2_label` - Statistik kedua
- `stat_3_value`, `stat_3_label` - Statistik ketiga
- `button_1_text`, `button_1_url` - Tombol pertama (teks & URL)
- `button_2_text`, `button_2_url` - Tombol kedua
- `button_2_anchor` - Target anchor untuk tombol kedua

### 2. **Filament Resource**

- **Lokasi**: `app/Filament/Resources/HeroSettings/HeroSettingResource.php`
- **Formulir**: `app/Filament/Resources/HeroSettings/Schemas/HeroSettingForm.php`
- **Tabel**: `app/Filament/Resources/HeroSettings/Tables/HeroSettingsTable.php`

Resource ini menyediakan interface untuk mengelola Hero Settings dengan:

- Form terorganisir dalam 3 section:
    - **Konten Utama** - Judul, highlight, dan deskripsi
    - **Statistik** - 3 statistik dengan nilai dan label
    - **Tombol** - Konfigurasi 2 tombol dengan teks, URL, dan anchor

### 3. **Blade Component**

- **File**: `resources/views/components/hero.blade.php`

Component ini sekarang mengambil data dari database:

```blade
@php
    $heroSetting = \App\Models\HeroSetting::settings();
@endphp
```

Kemudian menampilkan konten dinamis menggunakan:

- `{{ $heroSetting->title }}`
- `{{ $heroSetting->description }}`
- `{{ $heroSetting->stat_1_value }}`, dll
- `{{ $heroSetting->button_1_text }}`, dll

## Cara Menggunakan

### Akses Admin Panel

1. Buka admin Filament di URL yang sudah dikonfigurasi (biasanya `/admin`)
2. Login dengan akun admin
3. Di sidebar, cari menu **"Pengaturan Hero"**
4. Klik menu tersebut untuk membuka halaman pengaturan

### Mengedit Hero Settings

1. Di halaman Pengaturan Hero, klik tombol **"Edit"** atau **"Buka Catatan"**
2. Form akan menampilkan field berikut yang dapat diedit:

#### Konten Utama

- **Judul Utama** - Teks judul (wajib diisi)
- **Judul Highlight** - Bagian yang akan di-highlight dengan warna berbeda
- **Deskripsi** - Paragraf deskripsi lengkap (wajib diisi)

#### Statistik

- **Stat 1** - Nilai & Label (contoh: "8.240" & "Arsip Digital")
- **Stat 2** - Nilai & Label
- **Stat 3** - Nilai & Label

#### Tombol

- **Tombol 1** - Teks & URL (contoh: "Ajukan Permohonan" & "/permohonan")
- **Tombol 2** - Teks & URL (contoh: "Jelajahi Layanan" & "#layanan")
- **Tombol 2 Anchor** - Target ID element (contoh: "layanan")

3. Setelah selesai mengedit, klik tombol **"Simpan"**
4. Perubahan akan langsung ditampilkan di website

## Data Default (First Run)

Saat pertama kali mengakses halaman Hero, sistem otomatis membuat record dengan data default:

```
Title: "Arsip & Literasi"
Title Accent: "untuk Semarang"
Description: "Portal informasi publik Dinas Arsip dan Perpustakaan Kota Semarang..."
Stat 1: "8.240" / "Arsip Digital"
Stat 2: "42.680" / "Koleksi Buku"
Stat 3: "97,8%" / "Tingkat Kepuasan"
Button 1: "Ajukan Permohonan" / "#"
Button 2: "Jelajahi Layanan" / "#layanan"
```

## Struktur File

```
app/
├── Models/
│   └── HeroSetting.php
└── Filament/Resources/
    └── HeroSettings/
        ├── HeroSettingResource.php
        ├── Schemas/
        │   └── HeroSettingForm.php
        ├── Tables/
        │   └── HeroSettingsTable.php
        └── Pages/
            ├── ListHeroSettings.php
            ├── CreateHeroSetting.php
            └── EditHeroSetting.php

database/migrations/
└── 2026_04_09_054331_create_hero_settings_table.php

resources/views/components/
└── hero.blade.php
```

## Model Helper Method

Model `HeroSetting` memiliki method helper bernama `settings()`:

```php
// Mengambil atau membuat record hero settings
$heroSetting = \App\Models\HeroSetting::settings();

// Mengakses properti
echo $heroSetting->title;
echo $heroSetting->description;
```

Method ini menggunakan pola **Singleton** untuk memastikan hanya ada 1 record hero settings di database.

## Tips & Trik

### Di Blade Template

Jika Anda ingin menggunakan hero settings di template lain:

```blade
@php
    $hero = \App\Models\HeroSetting::settings();
@endphp

<h1>{{ $hero->title }}</h1>
<p>{{ $hero->description }}</p>
```

### Di Controller

```php
$heroSetting = \App\Models\HeroSetting::settings();
return view('home', ['hero' => $heroSetting]);
```

### Membuat Backup/Reset

Jika ingin mereset ke nilai default:

```php
// Di Tinker atau console
\App\Models\HeroSetting::first()->update([
    'title' => 'Arsip & Literasi',
    'title_accent' => 'untuk Semarang',
    // ... field lainnya
]);
```

## Troubleshooting

### Menu "Pengaturan Hero" tidak muncul di admin?

- Pastikan sudah menjalankan: `php artisan migrate`
- Clear cache: `php artisan cache:clear`
- Refresh halaman admin

### Perubahan tidak tampil di website?

- Cek apakah hero component sudah di-update
- Clear Laravel cache: `php artisan cache:clear`
- Clear browser cache atau refresh page

### Error "Table doesn't exist"?

- Pastikan migration sudah berjalan: `php artisan migrate`

## Ke Depan (Fitur Tambahan)

Anda bisa menambahkan fitur berikut:

- Upload gambar/background di hero settings
- Warna custom untuk title accent
- Multiple hero settings (untuk halaman berbeda)
- Versioning/history perubahan
- Preview live sebelum save

---

**Dibuat**: 9 April 2026  
**Terakhir diperbarui**: 9 April 2026
