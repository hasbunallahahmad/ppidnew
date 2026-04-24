@extends('layouts.menu-page')

@push('styles')
    <style>
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        /* STATUS PAGE STYLING */
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

        .status-section {
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

        .status-overview {
            margin-bottom: 32px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .status-card {
            background: linear-gradient(135deg, var(--bg-light) 0%, #fafbfc 100%);
            padding: 24px;
            border-radius: var(--radius-sm);
            border-left: 4px solid var(--primary-light);
            border: 1px solid var(--border);
            border-left: 4px solid var(--primary-light);
            transition: all 0.3s ease;
        }

        .status-card:hover {
            box-shadow: var(--shadow-sm);
        }

        .status-card h5 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }

        .ticket-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-light);
            font-family: 'Courier New', monospace;
            margin-bottom: 0;
            letter-spacing: 2px;
            user-select: all;
        }

        .section-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--accent);
        }

        .detail-section {
            margin-bottom: 32px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .info-item {
            background: var(--bg-light);
            padding: 18px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .info-item:hover {
            box-shadow: var(--shadow-sm);
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-item label {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 10px;
            display: block;
            font-size: 0.95rem;
        }

        .info-item p {
            color: var(--text-body);
            margin-bottom: 0;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .info-item a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .info-item a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .timeline-section {
            margin-bottom: 32px;
        }

        .timeline-info {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .timeline-item {
            display: flex;
            gap: 16px;
            padding: 18px;
            background: var(--bg-light);
            border-radius: var(--radius-sm);
            border-left: 4px solid var(--primary-light);
            border: 1px solid var(--border);
            border-left: 4px solid var(--primary-light);
            transition: all 0.2s ease;
        }

        .timeline-item:hover {
            box-shadow: var(--shadow-sm);
        }

        .timeline-item i {
            font-size: 1.4rem;
            color: var(--primary-light);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .timeline-item h6 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 6px;
            font-size: 0.95rem;
        }

        .timeline-item p {
            color: var(--text-body);
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .alert-info {
            background: linear-gradient(135deg, #e7f3ff 0%, #f0f8ff 100%);
            border-left: 4px solid var(--primary-light);
            border-radius: var(--radius-sm);
            padding: 24px;
            margin: 32px 0;
            color: var(--text-dark);
            border: 1px solid rgba(26, 111, 204, 0.2);
        }

        .alert-heading {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 12px;
            font-size: 1rem;
        }

        .alert-info p {
            color: var(--text-body);
            margin-bottom: 0;
            line-height: 1.6;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffe7e7 0%, #fff5f5 100%);
            border-left: 4px solid var(--red);
            border-radius: var(--radius-sm);
            padding: 24px;
            margin: 32px 0;
            color: var(--text-dark);
            border: 1px solid rgba(214, 48, 49, 0.2);
        }

        .alert-danger h5,
        .alert-danger .alert-heading {
            color: var(--red);
            font-weight: 700;
        }

        .alert-danger p {
            color: var(--text-body);
            margin-bottom: 0;
            line-height: 1.6;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #fffaf0 100%);
            border-left: 4px solid var(--orange);
            border-radius: var(--radius-sm);
            padding: 24px;
            margin: 32px 0;
            color: var(--text-dark);
            border: 1px solid rgba(224, 117, 21, 0.2);
        }

        .alert-warning h5 {
            color: var(--orange);
            font-weight: 700;
            margin-bottom: 12px;
        }

        .alert-warning p {
            color: var(--text-body);
            line-height: 1.6;
        }

        .action-buttons {
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid var(--border);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .btn {
            font-weight: 600;
            border-radius: var(--radius-sm);
            padding: 13px 28px;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-lg {
            padding: 14px 32px;
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

        .badge {
            padding: 6px 12px;
            font-weight: 600;
            font-size: 0.85rem;
            border-radius: 20px;
        }

        /* Badge variants */
        .bg-warning {
            background-color: var(--orange) !important;
            color: white;
        }

        .bg-success {
            background-color: var(--green) !important;
        }

        .bg-danger {
            background-color: var(--red) !important;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .content-box {
                padding: 30px;
            }

            .content-box h2 {
                font-size: 1.5rem;
            }

            .status-overview {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .status-section {
                padding: 20px 0 !important;
            }

            .content-box {
                padding: 20px;
                border-radius: var(--radius-sm);
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .action-buttons {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .btn {
                padding: 12px 24px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 576px) {
            .content-box {
                padding: 16px;
            }

            .content-box h2 {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 1rem;
            }

            .info-item,
            .status-card,
            .timeline-item {
                padding: 14px;
            }

            .ticket-number {
                font-size: 1.2rem;
            }
        }
    </style>
@endpush

@section('page-content')
    <section class="status-section">
        <div>
            <div class="content-box">
                <h2>{{ $pageTitle }}</h2>

                @if ($permohonan)
                    <!-- Status Overview -->
                    <div class="status-overview mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="status-card">
                                    <h5>Nomor Tiket</h5>
                                    <p class="ticket-number">{{ $permohonan->nomor_tiket }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="status-card">
                                    <h5>Status Permohonan</h5>
                                    <p>
                                        @switch($permohonan->status)
                                            @case('pending')
                                                <span class="badge bg-warning text-dark">⏳ Menunggu Diproses</span>
                                            @break

                                            @case('diproses')
                                                <span class="badge bg-info">🔄 Sedang Diproses</span>
                                            @break

                                            @case('selesai')
                                                <span class="badge bg-success">✓ Selesai</span>
                                            @break

                                            @case('ditolak')
                                                <span class="badge bg-danger">✗ Ditolak</span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary">{{ ucfirst($permohonan->status) }}</span>
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Permohonan -->
                    <div class="detail-section mt-5">
                        <h4 class="section-title">Informasi Pemohon</h4>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Nama Pemohon:</label>
                                <p>{{ $permohonan->nama_pemohon }}</p>
                            </div>
                            <div class="info-item">
                                <label>Email:</label>
                                <p>
                                    <a href="mailto:{{ $permohonan->email }}">{{ $permohonan->email }}</a>
                                </p>
                            </div>
                            <div class="info-item">
                                <label>Nomor Telepon:</label>
                                <p>{{ $permohonan->no_telepon }}</p>
                            </div>
                            <div class="info-item">
                                <label>Jenis Identitas:</label>
                                <p>{{ $permohonan->jenis_identitas }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Permohonan Informasi -->
                    <div class="detail-section mt-4">
                        <h4 class="section-title">Detail Permohonan</h4>
                        <div class="info-item full-width">
                            <label>Informasi yang Diminta:</label>
                            <p>{{ $permohonan->informasi_diminta }}</p>
                        </div>
                        <div class="info-item full-width">
                            <label>Tujuan Penggunaan:</label>
                            <p>{{ $permohonan->tujuan_penggunaan }}</p>
                        </div>
                        <div class="info-item full-width">
                            <label>Cara Mendapatkan Informasi:</label>
                            <p>{{ $permohonan->cara_mendapatkan }}</p>
                        </div>
                    </div>

                    <!-- Timeline & Deadline -->
                    <div class="timeline-section mt-5">
                        <h4 class="section-title">Timeline</h4>
                        <div class="timeline-info">
                            <div class="timeline-item">
                                <i class="fas fa-calendar-check"></i>
                                <div>
                                    <h6>Tanggal Pengajuan</h6>
                                    <p>{{ $permohonan->created_at->format('d F Y H:i') }}</p>
                                </div>
                            </div>

                            @if ($permohonan->deadline_at)
                                <div class="timeline-item">
                                    <i class="fas fa-hourglass-end text-warning"></i>
                                    <div>
                                        <h6>Deadline Respons</h6>
                                        <p>{{ $permohonan->deadline_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($permohonan->selesai_at)
                                <div class="timeline-item">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <div>
                                        <h6>Tanggal Selesai</h6>
                                        <p>{{ $permohonan->selesai_at->format('d F Y H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Catatan Jika Ada -->
                    @if ($permohonan->catatan_admin)
                        <div class="alert alert-info mt-5">
                            <h5 class="alert-heading">Catatan Admin</h5>
                            <p class="mb-0">{{ $permohonan->catatan_admin }}</p>
                        </div>
                    @endif

                    @if ($permohonan->alasan_penolakan && $permohonan->status == 'ditolak')
                        <div class="alert alert-danger mt-5">
                            <h5 class="alert-heading">Alasan Penolakan</h5>
                            <p class="mb-0">{{ $permohonan->alasan_penolakan }}</p>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="action-buttons mt-5 pt-4 border-top">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('permohonan.form') }}" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-plus me-2"></i> Buat Permohonan Baru
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg w-100">
                                    <i class="fas fa-home me-2"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning mt-4">
                        <h5>Permohonan Tidak Ditemukan</h5>
                        <p>Periksakan kembali nomor tiket Anda atau hubungi kami untuk bantuan lebih lanjut.</p>
                    </div>
                @endif
            </div>
        </div>
        </div>
    </section>
@endsection
