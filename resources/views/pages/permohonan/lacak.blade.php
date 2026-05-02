@extends('layouts.menu-page')

{{--
    ╔══════════════════════════════════════════════════════════════╗
    ║  pages/permohonan/lacak.blade.php                           ║
    ║  Lacak Status Permohonan Informasi Publik                   ║
    ╠══════════════════════════════════════════════════════════════╣
    ║  PERUBAHAN & FIX:                                           ║
    ║  - pattern HTML diselaraskan dengan generateNomorTiket()    ║
    ║    → PPID-YYYY-XXXXXX (bukan PPID-YYYYMMDD-####)           ║
    ║  - minlength/maxlength dikoreksi ke 16                      ║
    ║  - $error dari controller sekarang ditampilkan              ║
    ║  - Email di-mask untuk keamanan data publik                 ║
    ║  - CSS dipindah ke section styles (seharusnya ke app.css)   ║
    ║  - Kolom informasi_diminta & tujuan_penggunaan ditampilkan  ║
    ║  - JS auto-format & validasi diperketat                     ║
    ╚══════════════════════════════════════════════════════════════╝
--}}

@push('styles')
{{--
    NOTE: Idealnya semua CSS di bawah ini dipindahkan ke app.css
    dan di-compile melalui Vite. Diletakkan di sini hanya untuk
    kemudahan review. Gunakan class prefix `.lacak-` untuk menghindari
    konflik global.
--}}
<style>
/* ── Layout utama ────────────────────────────────────────── */
.lacak-section {
    background: linear-gradient(180deg, #f8fafb 0%, #ffffff 100%);
    padding: 40px 0;
    min-height: 100vh;
}

.lacak-box {
    background: var(--bg-white);
    padding: 40px;
    border-radius: var(--radius);
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border);
}

/* ── Typography ──────────────────────────────────────────── */
.lacak-box h2 {
    color: var(--text-dark);
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 12px;
    font-family: var(--font-display);
}

.lacak-lead {
    font-size: 1rem;
    color: var(--text-body);
    margin-bottom: 24px;
    line-height: 1.6;
}

/* ── Alert info ──────────────────────────────────────────── */
.lacak-alert-info {
    background: linear-gradient(135deg, #e7f3ff 0%, #f0f8ff 100%);
    border-left: 4px solid var(--primary-light);
    border-radius: var(--radius-sm);
    padding: 16px 20px;
    margin-bottom: 30px;
    color: var(--text-dark);
    font-size: 0.93rem;
}
.lacak-alert-info strong { color: var(--primary); }

/* ── Alert error (server-side) ───────────────────────────── */
.lacak-alert-error {
    background: #fef2f2;
    border-left: 4px solid #dc2626;
    border-radius: var(--radius-sm);
    padding: 16px 20px;
    margin-top: 24px;
    color: #991b1b;
    font-size: 0.93rem;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}
.lacak-alert-error i { margin-top: 2px; flex-shrink: 0; }

/* ── Form ────────────────────────────────────────────────── */
.lacak-form-label {
    color: var(--text-dark);
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 8px;
    display: block;
}

.lacak-form-hint {
    display: block;
    margin-top: 6px;
    font-size: 0.82rem;
    color: var(--text-muted, #6b7280);
}

.lacak-form-control {
    width: 100%;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 10px 14px;
    font-size: 0.95rem;
    font-family: var(--font-mono, 'Courier New', monospace);
    letter-spacing: 0.04em;
    background-color: #ffffff;
    color: var(--text-body);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    box-sizing: border-box;
}
.lacak-form-control:focus {
    border-color: var(--primary-light);
    box-shadow: 0 0 0 3px rgba(26, 111, 204, 0.1);
    outline: none;
}
.lacak-form-control.is-invalid {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

/* ── Buttons ─────────────────────────────────────────────── */
.lacak-btn {
    font-weight: 600;
    border-radius: var(--radius-sm);
    padding: 11px 24px;
    font-size: 0.95rem;
    transition: all 0.25s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    text-decoration: none;
}
.lacak-btn-primary {
    background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
    color: #ffffff;
}
.lacak-btn-primary:hover {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    transform: translateY(-1px);
    box-shadow: var(--shadow-lg);
    color: #ffffff;
}
.lacak-btn-primary:disabled {
    opacity: 0.65;
    cursor: not-allowed;
    transform: none;
}
.lacak-btn-outline {
    background: transparent;
    color: var(--text-body);
    border: 1.5px solid var(--border);
}
.lacak-btn-outline:hover {
    background: var(--bg-light);
    border-color: var(--text-body);
    color: var(--text-dark);
}

/* ── Loading spinner ─────────────────────────────────────── */
.lacak-spinner-wrap {
    display: none;
    text-align: center;
    padding: 20px 0;
}
.lacak-spinner-wrap.show { display: block; }
.lacak-spinner {
    border: 3px solid #f3f3f3;
    border-top: 3px solid var(--primary-light);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: lacak-spin 0.9s linear infinite;
    margin: 0 auto 10px;
}
@keyframes lacak-spin {
    to { transform: rotate(360deg); }
}

/* ── Result card ─────────────────────────────────────────── */
.lacak-result {
    margin-top: 32px;
    animation: lacak-fade-in 0.4s ease;
}
@keyframes lacak-fade-in {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

.lacak-result-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.lacak-detail-table {
    background: var(--bg-light);
    border-radius: var(--radius-sm);
    overflow: hidden;
    margin-bottom: 20px;
}

.lacak-detail-row {
    display: flex;
    padding: 13px 18px;
    border-bottom: 1px solid var(--border);
    font-size: 0.93rem;
    line-height: 1.5;
}
.lacak-detail-row:last-child { border-bottom: none; }

.lacak-detail-label {
    flex: 0 0 190px;
    font-weight: 600;
    color: var(--text-dark);
    padding-right: 12px;
}
.lacak-detail-value {
    flex: 1;
    color: var(--text-body);
    word-break: break-word;
}

/* ── Status badge ────────────────────────────────────────── */
.lacak-badge {
    display: inline-block;
    padding: 4px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.02em;
}
.lacak-badge--masuk    { background: #dbeafe; color: #1e40af; }
.lacak-badge--diproses { background: #fef3c7; color: #92400e; }
.lacak-badge--selesai  { background: #d1fae5; color: #065f46; }
.lacak-badge--ditolak  { background: #fee2e2; color: #991b1b; }
.lacak-badge--banding  { background: #f3f4f6; color: #374151; }

/* ── Deadline & terlambat ────────────────────────────────── */
.lacak-deadline-ok      { color: var(--green, #16a34a); font-weight: 600; }
.lacak-deadline-warning { color: #d97706; font-weight: 600; }
.lacak-deadline-late    { color: #dc2626; font-weight: 600; }

/* ── Info box (butuh bantuan) ────────────────────────────── */
.lacak-info-box {
    background: #fffbeb;
    padding: 16px 18px;
    border-radius: var(--radius-sm);
    border-left: 4px solid #f59e0b;
    font-size: 0.9rem;
    color: var(--text-dark);
}
.lacak-info-box p {
    margin: 8px 0 0;
    color: var(--text-body);
}

/* ── Responsive ──────────────────────────────────────────── */
@media (max-width: 992px) {
    .lacak-box { padding: 30px; }
    .lacak-box h2 { font-size: 1.5rem; }
}
@media (max-width: 768px) {
    .lacak-section { padding: 20px 0; }
    .lacak-box { padding: 20px; border-radius: var(--radius-sm); }
    .lacak-detail-row { flex-direction: column; gap: 4px; }
    .lacak-detail-label { flex: none; }
    .lacak-form-control { font-size: 1rem; } /* Hindari zoom di iOS */
}
</style>
@endpush

@section('page-content')
<section class="lacak-section">
    <div class="container">
        <div class="lacak-box">

            {{-- ── Judul & deskripsi ──────────────────────────────── --}}
            <h2>{{ $pageTitle }}</h2>
            <p class="lacak-lead">{{ $pageDescription }}</p>

            {{-- ── Informasi format nomor tiket ──────────────────── --}}
            <div class="lacak-alert-info" role="note">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
                <strong>Perhatian:</strong>
                Masukkan nomor tiket yang Anda terima setelah mengajukan permohonan.
                Format nomor tiket: <strong>PPID-YYYY-XXXXXX</strong>
                &nbsp;(contoh: <code>PPID-2026-S4NSGJ</code>)
            </div>

            {{-- ── Form GET — tidak perlu @csrf ──────────────────── --}}
            <form
                id="lacakForm"
                action="{{ route('permohonan.lacak') }}"
                method="GET"
                novalidate
            >
                <div class="mb-3">
                    <label for="nomor_tiket" class="lacak-form-label">
                        Nomor Tiket Permohonan
                        <span class="text-danger" aria-hidden="true">*</span>
                    </label>
                    <input
                        type="text"
                        class="lacak-form-control {{ $error ? 'is-invalid' : '' }}"
                        id="nomor_tiket"
                        name="nomor_tiket"
                        placeholder="Contoh: PPID-2026-S4NSGJ"
                        value="{{ old('nomor_tiket', request('nomor_tiket')) }}"
                        maxlength="16"
                        autocomplete="off"
                        spellcheck="false"
                        aria-describedby="tiketHint"
                        aria-required="true"
                        aria-invalid="{{ $error ? 'true' : 'false' }}"
                    >
                    {{--
                        NOTE: Atribut `pattern` dan `required` SENGAJA tidak dipasang
                        di HTML karena:
                        1. Validasi format sudah ditangani sepenuhnya di controller
                           (preg_match '/^PPID-\d{4}-[A-Z0-9]{6}$/').
                        2. Browser native validation UI (tooltip "Please match the
                           requested format") tidak bisa dikustomisasi secara konsisten
                           lintas browser dan tidak bisa diinternasionalisasi.
                        3. `novalidate` dipasang di <form> dan validasi JS di bawah
                           menangani feedback yang lebih baik ke pengguna.
                    --}}
                    <small id="tiketHint" class="lacak-form-hint">
                        <i class="fas fa-keyboard" aria-hidden="true"></i>
                        Format: <strong>PPID-YYYY-XXXXXX</strong> — 6 karakter alfanumerik (huruf & angka)
                    </small>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <button
                            type="submit"
                            id="lacakBtn"
                            class="lacak-btn lacak-btn-primary"
                        >
                            <i class="fas fa-search" aria-hidden="true"></i>
                            Lacak Permohonan
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a
                            href="{{ route('permohonan.form') }}"
                            class="lacak-btn lacak-btn-outline"
                        >
                            <i class="fas fa-plus-circle" aria-hidden="true"></i>
                            Ajukan Permohonan Baru
                        </a>
                    </div>
                </div>
            </form>

            {{-- ── Loading spinner (JS-controlled) ───────────────── --}}
            <div class="lacak-spinner-wrap" id="lacakSpinner" aria-live="polite" aria-label="Mencari data...">
                <div class="lacak-spinner" role="status"></div>
                <p style="color: var(--text-body); font-size: 0.9rem;">Mencari data permohonan...</p>
            </div>

            {{-- ── Error dari server (controller) ─────────────────── --}}
            @if ($error)
                <div class="lacak-alert-error" role="alert" id="serverError">
                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                    <div>
                        <strong>Permohonan tidak ditemukan</strong>
                        <p style="margin: 4px 0 0;">{{ $error }}</p>
                    </div>
                </div>
            @endif

            {{-- ── Hasil pencarian ─────────────────────────────────── --}}
            @if (request('nomor_tiket') && $permohonan)

                {{--
                    KEAMANAN: email di-mask agar tidak terekspos sepenuhnya
                    di halaman publik. Contoh: j***@gmail.com
                --}}
                @php
                    $emailParts   = explode('@', $permohonan->email ?? '');
                    $localPart    = $emailParts[0] ?? '';
                    $domain       = $emailParts[1] ?? '';
                    $maskedLocal  = substr($localPart, 0, 1)
                                   . str_repeat('*', max(1, strlen($localPart) - 1));
                    $maskedEmail  = $maskedLocal . '@' . $domain;

                    // Sisa hari deadline
                    $sisaHari    = $permohonan->sisa_hari;
                    $terlambat   = $permohonan->isTerlambat();

                    if ($terlambat) {
                        $deadlineClass = 'lacak-deadline-late';
                        $deadlineInfo  = '⚠ TERLAMBAT — ' . abs($sisaHari) . ' hari lewat deadline';
                    } elseif ($sisaHari <= 3) {
                        $deadlineClass = 'lacak-deadline-warning';
                        $deadlineInfo  = $sisaHari . ' hari kerja lagi';
                    } else {
                        $deadlineClass = 'lacak-deadline-ok';
                        $deadlineInfo  = $sisaHari . ' hari kerja lagi';
                    }
                @endphp

                <div class="lacak-result" role="region" aria-label="Hasil pencarian permohonan">

                    <div class="lacak-result-title">
                        <i class="fas fa-file-alt" style="color: var(--primary-light);" aria-hidden="true"></i>
                        Detail Permohonan
                    </div>

                    <div class="lacak-detail-table">

                        <div class="lacak-detail-row">
                            <div class="lacak-detail-label">Nomor Tiket</div>
                            <div class="lacak-detail-value">
                                <strong>{{ $permohonan->nomor_tiket }}</strong>
                            </div>
                        </div>

                        <div class="lacak-detail-row">
                            <div class="lacak-detail-label">Nama Pemohon</div>
                            <div class="lacak-detail-value">
                                {{ $permohonan->nama_pemohon }}
                            </div>
                        </div>

                        <div class="lacak-detail-row">
                            <div class="lacak-detail-label">Email</div>
                            <div class="lacak-detail-value">
                                <span title="Email disamarkan untuk keamanan data">
                                    {{ $maskedEmail }}
                                </span>
                            </div>
                        </div>

                        <div class="lacak-detail-row">
                            <div class="lacak-detail-label">Tanggal Pengajuan</div>
                            <div class="lacak-detail-value">
                                {{ $permohonan->created_at->translatedFormat('d F Y, H:i') }} WIB
                            </div>
                        </div>

                        <div class="lacak-detail-row">
                            <div class="lacak-detail-label">Status</div>
                            <div class="lacak-detail-value">
                                <span class="lacak-badge lacak-badge--{{ $permohonan->status }}">
                                    {{ $permohonan->status_label }}
                                </span>
                            </div>
                        </div>

                        <div class="lacak-detail-row">
                            <div class="lacak-detail-label">Informasi Diminta</div>
                            <div class="lacak-detail-value">
                                {{ $permohonan->informasi_diminta }}
                            </div>
                        </div>

                        <div class="lacak-detail-row">
                            <div class="lacak-detail-label">Tujuan Penggunaan</div>
                            <div class="lacak-detail-value">
                                {{ $permohonan->tujuan_penggunaan }}
                            </div>
                        </div>

                        <div class="lacak-detail-row">
                            <div class="lacak-detail-label">Batas Waktu Respon</div>
                            <div class="lacak-detail-value">
                                <span class="{{ $deadlineClass }}">
                                    {{ $permohonan->deadline_at->translatedFormat('d F Y') }}
                                    &mdash; {{ $deadlineInfo }}
                                </span>
                            </div>
                        </div>

                        @if ($permohonan->selesai_at)
                            <div class="lacak-detail-row">
                                <div class="lacak-detail-label">Tanggal Selesai</div>
                                <div class="lacak-detail-value">
                                    {{ $permohonan->selesai_at->translatedFormat('d F Y, H:i') }} WIB
                                </div>
                            </div>
                        @endif

                        @if ($permohonan->catatan_admin)
                            <div class="lacak-detail-row">
                                <div class="lacak-detail-label">Catatan Admin</div>
                                <div class="lacak-detail-value">
                                    {{ $permohonan->catatan_admin }}
                                </div>
                            </div>
                        @endif

                        @if ($permohonan->alasan_penolakan)
                            <div class="lacak-detail-row">
                                <div class="lacak-detail-label">Alasan Penolakan</div>
                                <div class="lacak-detail-value" style="color: #dc2626;">
                                    {{ $permohonan->alasan_penolakan }}
                                </div>
                            </div>
                        @endif

                    </div>{{-- /.lacak-detail-table --}}

                    {{-- ── Info bantuan ──────────────────────────────── --}}
                    <div class="lacak-info-box" role="note">
                        <i class="fas fa-lightbulb" style="color: #f59e0b;" aria-hidden="true"></i>
                        <strong>Butuh bantuan?</strong>
                        <p>
                            Jika ada pertanyaan mengenai permohonan Anda, silakan hubungi kami di
                            <a href="mailto:dinas_arpus@semarangkota.go.id" style="color: var(--primary-light);">
                                dinas_arpus@semarangkota.go.id
                            </a>
                            atau hubungi <strong>Admin PPID</strong> di
                            <a href="tel:+6281222233860" style="color: var(--primary-light);">
                                0812-2223-3860
                            </a>.
                        </p>
                    </div>

                </div>{{-- /.lacak-result --}}

            @endif

        </div>{{-- /.lacak-box --}}
    </div>{{-- /.container --}}
</section>
@endsection

@push('scripts')
<script>
/**
 * Lacak Permohonan — Client-side enhancement
 *
 * Validasi dilakukan di JS (bukan via HTML `pattern`) agar:
 * - Feedback bisa ditampilkan dalam Bahasa Indonesia
 * - UI konsisten lintas browser (Chrome, Firefox, Safari)
 * - Tetap berfungsi meskipun JS disabled (fallback ke server-side)
 */
(function () {
    'use strict';

    const TIKET_REGEX   = /^PPID-\d{4}-[A-Z0-9]{6}$/;
    const TIKET_EXAMPLE = 'PPID-2026-S4NSGJ';

    const form    = document.getElementById('lacakForm');
    const input   = document.getElementById('nomor_tiket');
    const btn     = document.getElementById('lacakBtn');
    const spinner = document.getElementById('lacakSpinner');

    if (!form || !input) return;

    /** Auto-uppercase saat mengetik */
    input.addEventListener('input', function () {
        const pos = this.selectionStart;
        this.value = this.value.toUpperCase();
        this.setSelectionRange(pos, pos);
        clearError();
    });

    /** Tampilkan error inline dengan pesan Bahasa Indonesia */
    function showError(msg) {
        clearError();
        input.classList.add('is-invalid');
        input.setAttribute('aria-invalid', 'true');

        const err = document.createElement('small');
        err.id        = 'tiketError';
        err.className = 'lacak-form-hint';
        err.style.color = '#dc2626';
        err.setAttribute('role', 'alert');
        err.innerHTML = '<i class="fas fa-exclamation-triangle"></i> ' + msg;
        input.insertAdjacentElement('afterend', err);
        input.focus();
    }

    function clearError() {
        input.classList.remove('is-invalid');
        input.setAttribute('aria-invalid', 'false');
        document.getElementById('tiketError')?.remove();
    }

    /** Submit handler */
    form.addEventListener('submit', function (e) {
        const val = input.value.trim().toUpperCase();

        if (!val) {
            e.preventDefault();
            showError('Nomor tiket harus diisi.');
            return;
        }

        if (!TIKET_REGEX.test(val)) {
            e.preventDefault();
            showError(
                'Format tidak valid. Pastikan formatnya: <strong>PPID-YYYY-XXXXXX</strong> '
                + '(contoh: <strong>' + TIKET_EXAMPLE + '</strong>).'
            );
            return;
        }

        // Normalisasi value sebelum submit
        input.value = val;

        // Tampilkan spinner, nonaktifkan tombol
        if (spinner) spinner.classList.add('show');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Mencari...';
        }
    });

    /** Jika ada hasil/error dari server, scroll ke sana */
    const result      = document.querySelector('.lacak-result');
    const serverError = document.getElementById('serverError');

    if (result || serverError) {
        const target = result || serverError;
        setTimeout(function () {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 200);
    }

})();
</script>
@endpush
