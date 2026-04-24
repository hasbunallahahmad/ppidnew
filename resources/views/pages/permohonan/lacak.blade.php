@extends('layouts.menu-page')

@push('styles')
    <style>
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        /* LACAK PERMOHONAN STYLING */
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

        .lacak-section {
            background: linear-gradient(180deg, #f8fafb 0%, #ffffff 100%);
            padding: 40px 0 !important;
            min-height: 100vh;
        }

        .content-box {
            background: var(--bg-white);
            padding: 40px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
        }

        .content-box h2 {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 12px;
            font-family: var(--font-display);
        }

        .lead {
            font-size: 1rem;
            color: var(--text-body);
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .alert-info {
            background: linear-gradient(135deg, #e7f3ff 0%, #f0f8ff 100%);
            border-left: 4px solid var(--primary-light);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            margin-bottom: 30px;
            color: var(--text-dark);
        }

        .alert-info strong {
            color: var(--primary);
        }

        /* Form Styles */
        .form-label {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            font-size: 0.95rem;
            font-family: inherit;
            background-color: #ffffff;
            color: var(--text-body);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-light);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(26, 111, 204, 0.1);
            outline: none;
        }

        .btn {
            font-weight: 600;
            border-radius: var(--radius-sm);
            padding: 11px 24px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-lg {
            padding: 13px 28px;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        .btn-outline-secondary {
            background: transparent;
            color: var(--text-body);
            border: 1.5px solid var(--border);
        }

        .btn-outline-secondary:hover {
            background: var(--bg-light);
            border-color: var(--text-body);
            color: var(--text-dark);
        }

        .w-100 {
            width: 100% !important;
        }

        /* Result Card */
        .result-card {
            display: none;
            margin-top: 30px;
            animation: fadeIn 0.5s ease;
        }

        .result-card.show {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-badge.masuk {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-badge.diproses {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-badge.selesai {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-badge.ditolak {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-badge.banding {
            background-color: #f3f4f6;
            color: #374151;
        }

        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            flex: 0 0 180px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .detail-value {
            flex: 1;
            color: var(--text-body);
        }

        /* Loading Spinner */
        .loading-spinner {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .loading-spinner.show {
            display: block;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-light);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Error Message */
        .error-message {
            display: none;
            background: #fee2e2;
            border-left: 4px solid #dc2626;
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            margin-top: 20px;
            color: #991b1b;
        }

        .error-message.show {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .content-box {
                padding: 30px;
            }

            .content-box h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .lacak-section {
                padding: 20px 0 !important;
            }

            .content-box {
                padding: 20px;
                border-radius: var(--radius-sm);
            }

            .detail-row {
                flex-direction: column;
                gap: 4px;
            }

            .detail-label {
                flex: none;
            }
        }
    </style>
@endpush

@section('page-content')
    <section class="lacak-section">
        <div class="container">
            <div class="content-box">
                <h2>{{ $pageTitle }}</h2>
                <p class="lead">{{ $pageDescription }}</p>

                <div class="alert-info" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Perhatian:</strong> Masukkan nomor tiket yang Anda terima setelah mengajukan permohonan.
                    Format nomor tiket: <strong>PRM-XXXXXXXX-YYYYMMDD</strong>
                </div>

                {{-- Form Pencarian --}}
                <form id="lacakForm" action="{{ route('permohonan.lacak') }}" method="GET">
                    <div class="mb-3">
                        <label for="nomor_tiket" class="form-label">Nomor Tiket Permohonan <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nomor_tiket" name="nomor_tiket"
                            placeholder="Contoh: PPID-20260416-0001" value="{{ request('nomor_tiket') }}"
                            pattern="PPID-\d{8}-\d{4}" minlength="18" maxlength="18" required autocomplete="off">
                        <small class="form-text">Format: PPID-YYYYMMDD-#### (4 digit angka urut)</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-search me-2"></i> Lacak Permohonan
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('permohonan.form') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-plus-circle me-2"></i> Ajukan Permohonan Baru
                            </a>
                        </div>
                    </div>
                </form>

                {{-- Loading Spinner --}}
                <div class="loading-spinner" id="loadingSpinner">
                    <div class="spinner"></div>
                    <p style="margin-top: 10px; color: var(--text-body);">Mencari data permohonan...</p>
                </div>

                {{-- Error Message --}}
                <div class="error-message" id="errorMessage">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Data tidak ditemukan!</strong>
                    <p style="margin-top: 8px;">Nomor tiket yang Anda masukkan tidak ditemukan. Pastikan nomor tiket sudah
                        benar dan coba lagi.</p>
                </div>

                {{-- Result --}}
                @if (request('nomor_tiket') && isset($permohonan))
                    <div class="result-card show">
                        <h3 style="margin-bottom: 20px; color: var(--text-dark);">
                            <i class="fas fa-file-alt me-2" style="color: var(--primary-light);"></i>
                            Detail Permohonan
                        </h3>

                        <div
                            style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-sm); margin-bottom: 20px;">
                            <div class="detail-row">
                                <div class="detail-label">Nomor Tiket</div>
                                <div class="detail-value">
                                    <strong>{{ $permohonan->nomor_tiket }}</strong>
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Nama Pemohon</div>
                                <div class="detail-value">{{ $permohonan->nama_pemohon }}</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Email</div>
                                <div class="detail-value">{{ $permohonan->email }}</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Tanggal Pengajuan</div>
                                <div class="detail-value">{{ $permohonan->created_at->format('d F Y H:i') }} WIB</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Status Permohonan</div>
                                <div class="detail-value">
                                    <span class="status-badge {{ $permohonan->status }}">
                                        {{ $permohonan->status_label }}
                                    </span>
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Informasi yang Diminta</div>
                                <div class="detail-value">{{ $permohonan->informasi_diminta }}</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Tujuan Penggunaan</div>
                                <div class="detail-value">{{ $permohonan->tujuan_penggunaan }}</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Deadline Respon</div>
                                <div class="detail-value">
                                    <strong
                                        style="{{ $permohonan->isTerlambat() ? 'color: #dc2626;' : 'color: var(--green);' }}">
                                        {{ $permohonan->deadline_at->format('d F Y') }}
                                        @if ($permohonan->isTerlambat())
                                            (TERLAMBAT)
                                        @else
                                            ({{ $permohonan->sisa_hari }} hari lagi)
                                        @endif
                                    </strong>
                                </div>
                            </div>

                            @if ($permohonan->selesai_at)
                                <div class="detail-row">
                                    <div class="detail-label">Tanggal Selesai</div>
                                    <div class="detail-value">{{ $permohonan->selesai_at->format('d F Y H:i') }} WIB</div>
                                </div>
                            @endif

                            @if ($permohonan->catatan_admin)
                                <div class="detail-row">
                                    <div class="detail-label">Catatan dari Admin</div>
                                    <div class="detail-value">{{ $permohonan->catatan_admin }}</div>
                                </div>
                            @endif

                            @if ($permohonan->alasan_penolakan)
                                <div class="detail-row">
                                    <div class="detail-label">Alasan Penolakan</div>
                                    <div class="detail-value" style="color: #dc2626;">{{ $permohonan->alasan_penolakan }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div
                            style="background: #fef3c7; padding: 16px; border-radius: var(--radius-sm); border-left: 4px solid #f59e0b;">
                            <i class="fas fa-lightbulb me-2" style="color: #f59e0b;"></i>
                            <strong>Butuh bantuan?</strong>
                            <p style="margin-top: 8px; margin-bottom: 0;">
                                Jika ada pertanyaan tentang permohonan Anda, silakan hubungi kami di
                                <a href="mailto:ppid@semarangkota.go.id"
                                    style="color: var(--primary-light);">dinas_arpus@semarangkota.go.id</a>
                                atau dapat menghubungi <strong>Admin PPID Dinas ( 6281222233860 )</strong>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('lacakForm');
            const spinner = document.getElementById('loadingSpinner');
            const error = document.getElementById('errorMessage');
            const input = document.getElementById('nomor_tiket');

            // Auto uppercase input
            input?.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });

            // Show loading on submit
            form?.addEventListener('submit', function(e) {
                if (form.checkValidity()) {
                    spinner.classList.add('show');
                    error.classList.remove('show');
                }
            });

            // Hide error on input change
            input?.addEventListener('input', function() {
                error.classList.remove('show');
            });
        });
    </script>
@endpush
