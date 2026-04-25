<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Model Permohonan Informasi Publik
 *
 * @property Carbon|null $deadline_at
 * @property Carbon|null $selesai_at
 * @property string $nomor_tiket
 * @property string $status
 * @property string|null $catatan_admin
 * @property string|null $alasan_penolakan
 */
class PermohonanInformasi extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'permohonan_informasis';

    protected $fillable = [
        'nama_pemohon',
        'email',
        'no_telepon',
        'alamat',
        'jenis_identitas',
        'no_identitas',
        'informasi_diminta',
        'tujuan_penggunaan',
        'cara_mendapatkan',
        'nomor_tiket',
        'status',
        'catatan_admin',
        'alasan_penolakan',
        'deadline_at',
        'selesai_at',
        'ip_address',
        'slug',
    ];

    protected function casts(): array
    {
        return [
            'deadline_at' => 'datetime',
            'selesai_at'  => 'datetime',
        ];
    }

    // =========================================================
    // Spatie Activitylog
    // =========================================================

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'catatan_admin', 'alasan_penolakan', 'selesai_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('permohonan');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    // =========================================================
    // Boot — auto generate nomor_tiket, deadline_at, dan sanitasi
    // =========================================================

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->slug = self::generateSlug();
        });

        static::creating(function (PermohonanInformasi $permohonan) {
            $permohonan->nomor_tiket = static::generateNomorTiket();
            $permohonan->deadline_at = static::hitungDeadline(now(), 10);
        });

        static::updating(function (PermohonanInformasi $permohonan) {
            if (
                $permohonan->isDirty('status')
                && in_array($permohonan->status, ['selesai', 'ditolak'])
                && $permohonan->selesai_at === null
            ) {
                $permohonan->selesai_at = now();
            }

            // Sanitize text fields saat update
            if ($permohonan->isDirty('catatan_admin')) {
                $permohonan->catatan_admin = static::sanitizeAdminInput($permohonan->catatan_admin);
            }
            if ($permohonan->isDirty('alasan_penolakan')) {
                $permohonan->alasan_penolakan = static::sanitizeAdminInput($permohonan->alasan_penolakan);
            }
        });
    }
    private static function generateSlug(): string
    {
        do {
            $slug = Str::uuid()->toString();
        } while (self::where('slug', $slug)->exists());

        return $slug;
    }

    public static function generateNomorTiket(): string
    {
        do {
            $nomor = 'PPID-' . date('Y') . '-' . strtoupper(Str::random(6));
        } while (static::withTrashed()->where('nomor_tiket', $nomor)->exists());

        return $nomor;
    }

    protected static function sanitizeAdminInput(?string $input): ?string
    {
        if ($input === null) {
            return null;
        }

        return trim(strip_tags($input));
    }
    // =========================================================
    // Security Helpers
    // =========================================================

    /**
     * Sanitize input untuk mencegah XSS attack.
     * Strip HTML tags dan encode special characters.
     */
    protected static function sanitizeInput(?string $input): ?string
    {
        if (empty($input)) {
            return $input;
        }

        // Strip semua HTML tag
        $sanitized = strip_tags($input);

        // Trim whitespace
        $sanitized = trim($sanitized);

        // Encode special characters
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return $sanitized;
    }

    // =========================================================
    // Scopes
    // =========================================================

    public function scopeMasuk(Builder $query): Builder
    {
        return $query->where('status', 'masuk');
    }

    public function scopeDiproses(Builder $query): Builder
    {
        return $query->where('status', 'diproses');
    }

    public function scopeSelesai(Builder $query): Builder
    {
        return $query->where('status', 'selesai');
    }

    public function scopeDitolak(Builder $query): Builder
    {
        return $query->where('status', 'ditolak');
    }

    /**
     * Permohonan yang mendekati atau sudah melewati deadline.
     * Dipakai untuk widget peringatan di Filament dashboard.
     */
    public function scopeMendekatiDeadline(Builder $query, int $hariSebelum = 3): Builder
    {
        return $query->whereIn('status', ['masuk', 'diproses'])
            ->whereDate('deadline_at', '<=', now()->addDays($hariSebelum));
    }

    public function scopeTerlambat(Builder $query): Builder
    {
        return $query->whereIn('status', ['masuk', 'diproses'])
            ->whereDate('deadline_at', '<', now());
    }

    // =========================================================
    // Helpers
    // =========================================================

    /**
     * Generate nomor tiket unik format: PPID-YYYYMMDD-XXXX
     * Contoh: PPID-20250317-0042
     */


    /**
     * Hitung deadline kerja (+N hari kerja, skip Sabtu & Minggu).
     */
    public static function hitungDeadline(Carbon $dari, int $hariKerja): Carbon
    {
        $tanggal = $dari->copy();
        $hitung  = 0;

        while ($hitung < $hariKerja) {
            $tanggal->addDay();
            // Skip Sabtu (6) dan Minggu (0)
            if (!in_array($tanggal->dayOfWeek, [CarbonInterface::SATURDAY, CarbonInterface::SUNDAY])) {
                $hitung++;
            }
        }

        return $tanggal;
    }

    /**
     * Sisa hari kerja menuju deadline.
     * Return negatif jika sudah terlambat.
     */
    public function getSisaHariAttribute(): int
    {
        if (! $this->deadline_at) {
            return 0;
        }

        return (int) now()->startOfDay()->diffInDays($this->deadline_at->startOfDay(), false);
    }

    /**
     * Apakah permohonan ini sudah terlambat (melewati deadline dan belum selesai).
     */
    public function isTerlambat(): bool
    {
        return in_array($this->status, ['masuk', 'diproses'])
            && $this->deadline_at !== null
            && $this->deadline_at->isPast();
    }

    /**
     * Label warna status untuk badge di admin.
     */
    public function getStatusWarnaAttribute(): string
    {
        return match ($this->status) {
            'masuk'    => 'info',
            'diproses' => 'warning',
            'selesai'  => 'success',
            'ditolak'  => 'danger',
            'banding'  => 'gray',
            default    => 'gray',
        };
    }

    /**
     * Label human-readable untuk status.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'masuk'    => 'Masuk',
            'diproses' => 'Sedang Diproses',
            'selesai'  => 'Selesai',
            'ditolak'  => 'Ditolak',
            'banding'  => 'Banding',
            default    => $this->status,
        };
    }
}
