# Panduan Menambahkan Submenu "Lacak Permohonan" di Menu Manager

## 📋 Overview

Halaman lacak permohonan sudah dibuat di:
- **Route:** `permohonan.lacak` → `/permohonan/lacak`
- **Controller:** `PermohonanController@lacakPermohonan`
- **View:** `resources/views/pages/permohonan/lacak.blade.php`

---

## 🎯 Cara Menambahkan Submenu di Navbar

Karena Anda menggunakan **filament-menu-manager**, berikut cara menambahkan submenu:

### Opsi 1: Melalui Admin Panel (Recommended)

1. **Login ke Filament Admin**
   - Buka: `http://127.0.0.1:8000/admin`
   - Login dengan akun admin

2. **Buka Menu Manager**
   - Cari menu "Menu Manager" atau "Menus" di sidebar
   - Klik untuk membuka

3. **Edit Menu yang Aktif**
   - Pilih menu yang sedang digunakan (biasanya "Main Menu" atau "Primary Menu")
   - Klik "Edit"

4. **Tambahkan Submenu**
   
   **Parent Menu: "Ajukan Permohonan"** (jika belum ada, buat dulu):
   - **Label:** `Ajukan Permohonan`
   - **Type:** Custom URL / Route
   - **URL/Route:** `/permohonan/cara` atau `permohonan.care`
   - **Icon:** `fa-paper-plane` (opsional)
   - **Order/Sort:** Sesuaikan

   **Submenu 1: "Cara Permohonan"**
   - **Label:** `Cara Permohonan`
   - **Type:** Route
   - **Route:** `permohonan.care`
   - **Parent:** Ajukan Permohonan
   - **Icon:** `fa-info-circle`
   - **Order:** 1

   **Submenu 2: "Ajukan Permohonan"**
   - **Label:** `Form Permohonan`
   - **Type:** Route
   - **Route:** `permohonan.form`
   - **Parent:** Ajukan Permohonan
   - **Icon:** `fa-edit`
   - **Order:** 2

   **Submenu 3: "Lacak Permohonan"** ← BARU!
   - **Label:** `Lacak Permohonan`
   - **Type:** Route
   - **Route:** `permohonan.lacak`
   - **Parent:** Ajukan Permohonan
   - **Icon:** `fa-search`
   - **Order:** 3

5. **Save Menu**
   - Klik "Save" atau "Update Menu"
   - Clear cache jika perlu

---

### Opsi 2: Melalui Database Seeder (Untuk Development)

Jika ingin menambahkan via seeder, buat file baru:

**File:** `database/seeders/MenuPermohonanSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use NoteBrainsLab\FilamentMenuManager\Models\Menu;
use NoteBrainsLab\FilamentMenuManager\Models\MenuItem;

class MenuPermohonanSeeder extends Seeder
{
    public function run(): void
    {
        // Cari menu utama (sesuaikan dengan nama menu Anda)
        $menu = Menu::where('name', 'main')->first();
        
        if (!$menu) {
            $this->command->error('Menu "main" tidak ditemukan!');
            return;
        }

        // Buat parent menu "Ajukan Permohonan" jika belum ada
        $parentMenu = MenuItem::firstOrCreate(
            ['title' => 'Ajukan Permohonan'],
            [
                'menu_id' => $menu->id,
                'type' => 'route',
                'url' => 'permohonan.care',
                'icon' => 'fas fa-paper-plane',
                'order' => 3, // Sesuaikan urutan
                'is_active' => true,
                'parent_id' => null,
            ]
        );

        // Submenu: Cara Permohonan
        MenuItem::updateOrCreate(
            ['title' => 'Cara Permohonan', 'parent_id' => $parentMenu->id],
            [
                'menu_id' => $menu->id,
                'type' => 'route',
                'url' => 'permohonan.care',
                'icon' => 'fas fa-info-circle',
                'order' => 1,
                'is_active' => true,
                'parent_id' => $parentMenu->id,
            ]
        );

        // Submenu: Form Permohonan
        MenuItem::updateOrCreate(
            ['title' => 'Form Permohonan', 'parent_id' => $parentMenu->id],
            [
                'menu_id' => $menu->id,
                'type' => 'route',
                'url' => 'permohonan.form',
                'icon' => 'fas fa-edit',
                'order' => 2,
                'is_active' => true,
                'parent_id' => $parentMenu->id,
            ]
        );

        // Submenu: Lacak Permohonan (BARU!)
        MenuItem::updateOrCreate(
            ['title' => 'Lacak Permohonan', 'parent_id' => $parentMenu->id],
            [
                'menu_id' => $menu->id,
                'type' => 'route',
                'url' => 'permohonan.lacak',
                'icon' => 'fas fa-search',
                'order' => 3,
                'is_active' => true,
                'parent_id' => $parentMenu->id,
            ]
        );

        $this->command->info('✅ Menu permohonan berhasil ditambahkan!');
    }
}
```

**Jalankan Seeder:**
```bash
php artisan db:seed --class=MenuPermohonanSeeder
```

---

## 📍 Struktur Menu yang Akan Terbentuk

```
Navbar:
├── Beranda
├── Profil Dinas
├── Informasi Publik
├── Ajukan Permohonan ▼ (Parent Menu)
│   ├── Cara Permohonan
│   ├── Form Permohonan
│   └── Lacak Permohonan ← BARU!
└── Layanan
```

---

## 🧪 Testing

Setelah menu ditambahkan, test dengan:

1. **Buka homepage**
2. **Hover/klik menu "Ajukan Permohonan"**
3. **Seharusnya muncul dropdown:**
   - Cara Permohonan
   - Form Permohonan
   - **Lacak Permohonan** ← Baru!
4. **Klik "Lacak Permohonan"**
5. **Seharusnya membuka halaman lacak**

---

## 📝 Fitur Halaman Lacak

✅ **Input nomor tiket** dengan validasi format  
✅ **Auto uppercase** - Otomatis huruf besar semua  
✅ **Loading spinner** saat mencari  
✅ **Error handling** jika data tidak ditemukan  
✅ **Detail lengkap permohonan:**
   - Nomor tiket
   - Nama pemohon
   - Status dengan badge berwarna
   - Informasi yang diminta
   - Deadline & sisa hari
   - Catatan admin (jika ada)
   - Alasan penolakan (jika ada)

✅ **Responsive design** - Mobile friendly  
✅ **Status badge color-coded:**
   - 🔵 Masuk (biru)
   - 🟡 Diproses (kuning)
   - 🟢 Selesai (hijau)
   - 🔴 Ditolak (merah)
   - ⚫ Banding (abu-abu)

---

## 🔧 Troubleshooting

### Menu tidak muncul?
```bash
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Route tidak ditemukan?
Pastikan di `routes/web.php` ada:
```php
Route::get('/lacak', [PermohonanController::class, 'lacakPermohonan'])->name('lacak');
```

### Halaman error?
Check log di: `storage/logs/laravel.log`

---

**Created:** 15 April 2026  
**Route:** `permohonan.lacak`  
**URL:** `/permohonan/lacak`
