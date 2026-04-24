# 🔧 PDF Storage Configuration - Fix Guide

## Status: ✅ FIXED - 403 Forbidden Error Resolved

### Masalah yang Terjadi

- **Error**: 403 FORBIDDEN saat mengakses PDF di halaman publik
- **Penyebab**: File storage tidak dikonfigurasi dengan benar di Filament

### Solusi yang Diterapkan

#### 1. **Update Filament File Upload Component**

📁 File: `app/Filament/Resources/Pages/Schemas/PageForm.php`

```php
FileUpload::make('pdf_file')
    ->label('Upload PDF')
    ->disk('public')  // ✅ PENTING: Specify disk 'public'
    ->acceptedFileTypes(['application/pdf'])
    ->maxSize(10240)
    ->directory('pages-pdf')
    ->nullable()
```

**Penjelasan**: Disk `public` menggunakan symlink untuk akses publik (HTTP)

#### 2. **Update Laravel Storage Helper di View**

📁 File: `resources/views/pages/menu/page-detail.blade.php`

```blade
@if ($page->pdf_file)
    <iframe src="{{ Storage::disk('public')->url($page->pdf_file) }}"
            width="100%" height="600">
    </iframe>
@endif
```

**Penjelasan**: `Storage::disk('public')->url()` generates correct public URL

#### 3. **Create Storage Link** (Already Done)

```bash
php artisan storage:link
```

Hasil:

- Creates symlink: `public/storage` → `storage/app/public`
- Now files accessible via: `http://localhost:8000/storage/pages-pdf/filename.pdf`

#### 4. **Setup Folder Structure**

✅ Created: `storage/app/public/pages-pdf/`

- Files uploaded here are PUBLIC and accessible
- Permissions: Readable by web server

---

## 📊 How It Works Now

```
Admin Upload PDF
    ↓
Filament saves to: storage/app/public/pages-pdf/filename-random.pdf
    ↓
Database stores: pages-pdf/filename-random.pdf (relative path)
    ↓
Backend retrieves from DB and generates URL
    ↓
Storage::disk('public')->url() → /storage/pages-pdf/filename-random.pdf
    ↓
Browser accesses via symlink
    ↓
✅ PDF loads successfully (NO 403 error)
```

---

## ✅ Verification Checklist

- [x] Filament FileUpload uses `->disk('public')`
- [x] Blade view uses `Storage::disk('public')->url()`
- [x] Symlink created: `php artisan storage:link`
- [x] Folder exists: `storage/app/public/pages-pdf/`
- [x] Pages accessible without 403 error

---

## 🚀 Usage Instructions

### For Admin: Upload PDF

1. Login to: `http://localhost:8000/ppid-new-pusda-smg/pages`
2. Edit any page (e.g., "Struktur Organisasi")
3. Scroll to "File PDF" section
4. Click "Upload PDF" and select your file
5. Click "Save"
6. PDF is now accessible on frontend!

### For Users: View PDF

1. Navigate to page (e.g., `/page/struktur-organisasi`)
2. Scroll down to see PDF viewer
3. Click "Download" to download PDF file

---

## 🔍 Troubleshooting

### If Still Getting 403 Error

**Check 1: Verify storage:link**

```bash
php artisan storage:link
# Should show: The [public/storage] link has been connected...
```

**Check 2: Verify permissions**

```bash
# storage/app/public should be readable
chmod -R 755 storage/app/public
chmod -R 755 storage/app/public/pages-pdf
```

**Check 3: Clear cache**

```bash
php artisan view:clear
php artisan cache:clear
```

**Check 4: Verify disk configuration**
File: `config/filesystems.php`

```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
    'visibility' => 'public',
],
```

---

## 📝 Technical Details

### Storage Disks Configuration

- **local**: Private files (default, not accessible via HTTP)
- **public**: Public files (accessible via `/storage/` symlink)

### File Upload Flow

```
Admin → Filament Form
    ↓
FileUpload::make('pdf_file')->disk('public')
    ↓
Saves to: storage/app/public/pages-pdf/
    ↓
Database stores relative path: "pages-pdf/filename-xxx.pdf"
```

### Public URL Generation

```
Storage::disk('public')->url('pages-pdf/filename-xxx.pdf')
    ↓
Returns: /storage/pages-pdf/filename-xxx.pdf
    ↓
Browser request to: http://localhost:8000/storage/pages-pdf/filename-xxx.pdf
    ↓
Symlink redirects to: storage/app/public/pages-pdf/filename-xxx.pdf
    ↓
✅ File served successfully
```

---

## ✨ Summary

**Issue Fixed**: 403 FORBIDDEN error on PDF viewer  
**Root Cause**: Wrong storage disk configuration  
**Solution**: Use `disk('public')` + symlink  
**Result**: PDFs now accessible via HTTP without permission errors

**Status**: ✅ PRODUCTION READY
