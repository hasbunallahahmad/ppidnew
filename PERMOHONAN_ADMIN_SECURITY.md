# Permohonan Informasi - Filament Resource & Security Guide

## 📋 Overview
Sistem manajemen permohonan informasi publik yang terintegrasi dengan Filament Admin Panel, dengan fitur keamanan yang komprehensif untuk mencegah serangan XSS dan abuse.

---

## 🎯 Files Created/Modified

### 1. Filament Resource
**File:** `app/Filament/Resources/PermohonanInformasiResource.php`

**Features:**
- ✅ Form input dengan sanitasi otomatis
- ✅ Table display dengan proteksi XSS
- ✅ Status workflow management (masuk → diproses → selesai/ditolak)
- ✅ Advanced filtering (status, deadline, terlambat)
- ✅ Bulk actions untuk update status
- ✅ Export CSV dengan data yang disanitasi
- ✅ Global search pada field penting
- ✅ Navigation badge menunjukkan permohonan aktif

### 2. Resource Pages
- `ListPermohonanInformasis.php` - List semua permohonan
- `ViewPermohonanInformasi.php` - View detail permohonan
- `EditPermohonanInformasi.php` - Edit permohonan (admin)
- `CreatePermohonanInformasi.php` - Create (disabled, hanya dari public form)

### 3. Security Enhancements

#### A. StorePermohonanRequest (`app/Http/Requests/StorePermohonanRequest.php`)
```php
// Sanitasi input sebelum validasi
protected function sanitizeString(?string $input): string
{
    $sanitized = strip_tags($input);        // Remove HTML
    $sanitized = trim($sanitized);          // Trim whitespace
    $sanitized = htmlspecialchars(...);     // Encode special chars
    return $sanitized;
}
```

**Security Features:**
- ✅ Strip semua HTML tags
- ✅ Encode special characters (ENT_QUOTES | ENT_HTML5)
- ✅ Trim whitespace otomatis
- ✅ Regex validation untuk format data (email, telepon, dll)
- ✅ Rate limiting preparation

#### B. PermohonanController (`app/Http/Controllers/PermohonanController.php`)
```php
// Rate limiting: Max 5 submissions per IP per hour
$recentSubmissions = PermohonanInformasi::where('ip_address', $request->ip())
    ->where('created_at', '>=', now()->subHour())
    ->count();

if ($recentSubmissions >= 5) {
    return back()->withErrors(['error' => 'Terlalu banyak permohonan...']);
}
```

**Security Features:**
- ✅ Rate limiting (5 requests/IP/hour)
- ✅ IP address tracking
- ✅ Default status 'masuk' (bukan 'pending')
- ✅ Data yang sudah disanitasi langsung dari validated request

#### C. PermohonanInformasi Model (`app/Models/PermohonanInformasi.php`)
```php
// Auto-sanitize saat creating/updating
protected static function sanitizeInput(?string $input): ?string
{
    if (empty($input)) return $input;
    
    $sanitized = strip_tags($input);
    $sanitized = trim($sanitized);
    $sanitized = htmlspecialchars($sanitized, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    
    return $sanitized;
}
```

**Security Features:**
- ✅ Auto-sanitize text fields saat creating
- ✅ Auto-sanitize admin fields saat updating
- ✅ Double protection (Request + Model level)
- ✅ Sanitize fields: nama_pemohon, alamat, informasi_diminta, tujuan_penggunaan, catatan_admin, alasan_penolakan

---

## 🔒 Security Layers

### Layer 1: Frontend (HTML Form)
- HTML5 validation (pattern, min, max, required)
- JavaScript character counter
- Client-side sanitization (basic)

### Layer 2: Request Validation
- `prepareForValidation()` - Pre-sanitization
- Regex patterns untuk format data
- Min/max length validation
- `htmlspecialchars()` encoding

### Layer 3: Model Level
- `booted()` method auto-sanitize
- Strip tags protection
- Special character encoding

### Layer 4: Database
- Prepared statements (Laravel Eloquent)
- Type casting
- Fillable whitelist

### Layer 5: Display (Filament)
- `e()` helper untuk escape output
- Tooltips dengan encoded data
- CSV export dengan `htmlspecialchars()`

---

## 📊 Status Workflow

```
[masuk] → [diproses] → [selesai]
                       ↓
                    [ditolak]
                       ↓
                    [banding] (opsional)
```

**Status Descriptions:**
- `masuk` - Permohonan baru masuk ke sistem
- `diproses` - Admin sedang memproses permohonan
- `selesai` - Permohonan selesai, informasi sudah diberikan
- `ditolak` - Permohonan ditolak (wajib isi alasan_penolakan)
- `banding` - Ada banding dari pemohon

---

## 🎨 Filament Admin Features

### Table Features
- **Columns:** Nomor Tiket, Nama, Email, Telepon, Status, Deadline, dll
- **Badges:** Status dengan warna (info, warning, success, danger, gray)
- **Tooltips:** Hover untuk lihat data lengkap
- **Sorting:** Semua kolom penting bisa di-sort
- **Search:** Global search + column search

### Filters
- Filter by Status (multiple selection)
- Filter Terlambat (melewati deadline)
- Filter Mendekati Deadline (3 hari)
- Filter Hari Ini

### Bulk Actions
- **Update Status:** Ubah status multiple permohonan sekaligus
- **Delete:** Soft delete
- **Force Delete:** Hapus permanent
- **Restore:** Restore dari soft delete

### Export
- **CSV Export:** Download semua data ke CSV
- Sanitized data
- Timestamp dalam format ISO

---

## 🚀 Usage

### Access Admin Panel
1. Login ke Filament Admin: `/admin`
2. Navigate to: **Permohonan Informasi** di sidebar
3. Badge akan menunjukkan jumlah permohonan aktif

### View Permohonan
- **List View:** Lihat semua permohonan dalam table
- **View Action:** Lihat detail lengkap permohonan
- **Edit Action:** Edit status dan catatan admin

### Process Permohonan
1. Klik **Edit** pada permohonan
2. Ubah status sesuai workflow:
   - `masuk` → `diproses` (saat mulai proses)
   - `diproses` → `selesai` (saat selesai memberikan informasi)
   - `diproses` → `ditolak` (jika tidak bisa dipenuhi)
3. Tambahkan catatan admin (optional)
4. Jika ditolak, **wajib** isi alasan_penolakan
5. Save

### Bulk Processing
1. Select multiple permohonan
2. Pilih **Update Status** dari bulk actions
3. Pilih status baru
4. Tambahkan catatan (optional)
5. Confirm

---

## 🛡️ Security Best Practices Implemented

### 1. **Input Sanitization**
- Semua input dari public form disanitasi di 3 layer
- Request → Model → Display

### 2. **XSS Prevention**
- `strip_tags()` - Remove all HTML
- `htmlspecialchars()` - Encode special characters
- `e()` helper - Escape output di views

### 3. **Rate Limiting**
- Max 5 submissions per IP per hour
- Mencegah spam/abuse

### 4. **IP Tracking**
- Setiap permohonan mencatat IP address
- Audit trail untuk security

### 5. **Validation**
- Strict validation di Request level
- Regex patterns untuk format data
- Min/max length constraints

### 6. **Mass Assignment Protection**
- `$fillable` whitelist di model
- Hanya field yang diizinkan yang bisa diisi

### 7. **Soft Deletes**
- Data tidak benar-benar dihapus
- Bisa di-restore jika perlu
- Audit trail terjaga

---

## 📈 Monitoring & Reports

### Dashboard Widgets (Future Enhancement)
```php
// Contoh widget yang bisa ditambahkan
- Total permohonan hari ini
- Permohonan mendekati deadline
- Permohonan terlambat
- Statistik status
- Chart permohonan per bulan
```

### Export Reports
- CSV export untuk analisis di Excel
- Filter by date range
- Filter by status

---

## 🔧 Configuration

### Customization Points

**1. Rate Limiting Threshold**
```php
// File: PermohonanController.php
if ($recentSubmissions >= 5) { // ← Ubah angka ini
```

**2. Deadline Calculation**
```php
// File: PermohonanInformasi.php
$permohonan->deadline_at = static::hitungDeadline(now(), 10); // ← 10 hari kerja
```

**3. Status Options**
```php
// File: PermohonanInformasiResource.php
->options([
    'masuk' => 'Masuk',
    'diproses' => 'Sedang Diproses',
    'selesai' => 'Selesai',
    'ditolak' => 'Ditolak',
    'banding' => 'Banding',
])
```

---

## 🐛 Troubleshooting

### Issue: Data tidak tampil dengan benar
**Solution:** Pastikan `htmlspecialchars()` tidak double-encode. Data di database harus sudah ter-encode.

### Issue: Rate limit terlalu ketat
**Solution:** Ubah threshold di `PermohonanController.php` line ~45

### Issue: Filament resource tidak muncul
**Solution:** 
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

---

## 📝 Testing Checklist

- [ ] Submit form dengan HTML tags → harus di-strip
- [ ] Submit form dengan JavaScript injection → harus di-strip
- [ ] Submit 5+ permohonan dalam 1 jam → harus blocked
- [ ] Edit permohonan di admin → data tetap aman
- [ ] Export CSV → data sanitized
- [ ] Bulk update status → semua ter-update
- [ ] Filter by status → bekerja dengan benar
- [ ] Search → menemukan data yang relevan

---

## 🎓 Learning Points

### Defense in Depth
Sistem ini menggunakan **multiple layers of security**:
1. Frontend validation (easy to bypass, tapi UX bagus)
2. Request validation (first line of defense)
3. Model sanitization (second line of defense)
4. Output encoding (final protection)

### Why Multiple Layers?
- Jika satu layer fail, masih ada layer lain
- Defense in depth approach
- Meminimalkan risiko successful attack

---

## 📞 Support

Jika ada pertanyaan atau issue:
1. Check dokumentasi ini
2. Review code comments
3. Test dengan data dummy dulu

---

**Created:** 15 April 2026  
**Last Updated:** 15 April 2026  
**Version:** 1.0.0
