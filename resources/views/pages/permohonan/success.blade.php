@extends('layouts.menu-page')

@push('styles')
    <style>
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        /* SUCCESS PAGE STYLING */
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

        .success-section {
            background: linear-gradient(180deg, #f8fafb 0%, #ffffff 100%);
            padding: 60px 0 !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .success-container {
            background: var(--bg-white);
            padding: 50px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
        }

        .success-icon {
            text-align: center;
            margin-bottom: 30px;
        }

        .success-icon i {
            font-size: 5rem;
            color: var(--green);
            animation: scaleIn 0.6s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.3);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-title {
            text-align: center;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 24px;
            font-family: var(--font-display);
        }

        .success-message {
            text-align: center;
            margin-bottom: 32px;
        }

        .lead {
            font-size: 1.1rem;
            color: var(--text-body);
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .ticket-container {
            background: linear-gradient(135deg, var(--bg-light) 0%, #fafbfc 100%);
            padding: 28px;
            border-radius: var(--radius-sm);
            margin: 28px 0;
            border-left: 4px solid var(--primary-light);
            border: 1px solid var(--border);
            border-left: 4px solid var(--primary-light);
        }

        .ticket-container h5 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 16px;
            font-size: 1rem;
        }

        .ticket-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-light);
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
            padding: 18px;
            background: white;
            border: 2px dashed var(--primary-light);
            border-radius: var(--radius-sm);
            text-align: center;
            margin-bottom: 12px;
            user-select: all;
        }

        .timeline-container {
            margin: 40px 0;
        }

        .timeline-container h4 {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline-container h4 i {
            color: var(--accent);
            font-size: 1.3rem;
        }

        .timeline-item {
            display: flex;
            margin-bottom: 24px;
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .timeline-item:hover {
            opacity: 1;
        }

        .timeline-item.completed {
            opacity: 1;
        }

        .timeline-marker {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            background-color: #e9ecef;
            border: 2px solid var(--border);
            margin-right: 20px;
            flex-shrink: 0;
            margin-top: 2px;
            position: relative;
            transition: all 0.3s ease;
        }

        .timeline-item.completed .timeline-marker {
            background: linear-gradient(135deg, var(--green) 0%, #16a34a 100%);
            border-color: var(--green);
            box-shadow: 0 2px 8px rgba(26, 158, 106, 0.2);
        }

        .timeline-item.completed .timeline-marker::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
            font-size: 1rem;
        }

        .timeline-content h6 {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .timeline-content p {
            color: var(--text-body);
            margin-bottom: 0;
            font-size: 0.95rem;
            line-height: 1.5;
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
            margin-bottom: 16px;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-info ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .alert-info li {
            margin-bottom: 12px;
            padding-left: 24px;
            position: relative;
            color: var(--text-body);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .alert-info li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--green);
            font-weight: bold;
        }

        .alert-info strong {
            color: var(--primary);
            font-weight: 700;
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

        .faq-section {
            margin-top: 40px;
            padding-top: 40px;
            border-top: 1px solid var(--border);
        }

        .faq-section h5 {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .faq-section h5 i {
            color: var(--accent);
            font-size: 1.3rem;
        }

        .accordion-item {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            margin-bottom: 12px;
            overflow: hidden;
        }

        .accordion-button {
            background-color: var(--bg-light);
            border: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 14px 18px;
            transition: all 0.3s ease;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #e7f3ff 0%, #f0f8ff 100%);
            box-shadow: none;
            border: none;
            color: var(--primary);
        }

        .accordion-button:focus {
            border-color: transparent;
            box-shadow: none;
            outline: 2px solid var(--primary-light);
            outline-offset: -2px;
        }

        .accordion-body {
            color: var(--text-body);
            font-size: 0.95rem;
            line-height: 1.6;
            padding: 16px 18px;
            background: white;
        }

        /* Layout */
        .row {
            display: flex;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .success-container {
                padding: 40px;
            }

            .success-title {
                font-size: 1.5rem;
            }

            .success-icon i {
                font-size: 4rem;
            }
        }

        @media (max-width: 768px) {
            .success-section {
                padding: 30px 0 !important;
            }

            .success-container {
                padding: 30px;
                border-radius: var(--radius-sm);
            }

            .action-buttons {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .success-icon i {
                font-size: 3rem;
            }

            .ticket-number {
                font-size: 1.4rem;
                padding: 14px;
            }
        }

        @media (max-width: 576px) {
            .success-section {
                padding: 20px 0 !important;
            }

            .success-container {
                padding: 20px;
                border-radius: var(--radius-sm);
            }

            .success-title {
                font-size: 1.2rem;
            }

            .lead {
                font-size: 1rem;
            }

            .timeline-container h4 {
                font-size: 1rem;
            }

            .btn {
                padding: 11px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
@endpush

@section('page-content')
    <section class="success-section">
        <div>
            <div class="success-container">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

                <h2 class="success-title">{{ $pageTitle }}</h2>

                <div class="success-message">
                    <p class="lead">Terima kasih telah mengajukan permohonan informasi kepada kami!</p>

                    <div class="ticket-container">
                        <h5>Nomor Tiket Anda:</h5>
                        <div class="ticket-number">
                            {{ $nomor_tiket ?? 'N/A' }}
                        </div>
                        <small class="text-muted">Simpan nomor tiket ini untuk melacak status permohonan Anda</small>
                    </div>
                </div>

                <!-- Info Timeline -->
                <div class="timeline-container mt-5">
                    <h4 class="mb-4">
                        <i class="fas fa-clock me-2"></i> Tahapan Proses Permohonan
                    </h4>

                    <div class="timeline-item completed">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h6>Permohonan Diterima</h6>
                            <p>Permohonan Anda telah berhasil kami terima dan terdaftar dalam sistem.</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h6>Verifikasi Data</h6>
                            <p>Tim kami akan memverifikasi data dan kelengkapan permohonan Anda (1-2 hari kerja).</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h6>Pencarian Informasi</h6>
                            <p>Kami akan mencari informasi yang Anda minta (hingga 10 hari kerja).</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h6>Penyerahan Informasi</h6>
                            <p>Informasi akan dikirimkan sesuai dengan cara yang Anda pilih.</p>
                        </div>
                    </div>
                </div>

                <!-- Alert Info -->
                <div class="alert alert-info mt-5" role="alert">
                    <h5 class="alert-heading">
                        <i class="fas fa-info-circle me-2"></i> Yang Perlu Anda Ketahui
                    </h5>
                    <ul class="mb-0">
                        <li>Kami akan menghubungi Anda melalui email atau telepon jika ada informasi tambahan yang
                            diperlukan.</li>
                        <li>Batas maksimal respons adalah <strong>10 hari kerja</strong> sejak permohonan diterima.</li>
                        <li>Anda dapat memantau status permohonan dengan nomor tiket yang telah diberikan.</li>
                        <li>Jika ada pertanyaan, jangan ragu untuk menghubungi kami.</li>
                    </ul>
                </div>

                <!-- Buttons -->
                <div class="action-buttons mt-5 pt-4 border-top">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('permohonan.care') }}" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-question-circle me-2"></i> Lihat Panduan Selengkapnya
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-home me-2"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>

                <!-- FAQ Cepat -->
                <div class="faq-section mt-5 pt-5 border-top">
                    <h5 class="mb-4">
                        <i class="fas fa-question-circle me-2"></i> Pertanyaan Umum
                    </h5>

                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Bagaimana cara melacak status permohonan saya?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda dapat melacak status permohonan dengan menggunakan nomor tiket yang telah
                                    diberikan. Cukup masukkan nomor tiket pada halaman pencarian status permohonan.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2">
                                    Berapa lama proses permohonan?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Waktu respons maksimal adalah 10 hari kerja sejak permohonan diterima, sesuai dengan
                                    Undang-Undang Keterbukaan Informasi Publik.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3">
                                    Apakah ada biaya untuk permohonan?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Permohonan informasi tidak dikenai biaya administrasi. Namun, biaya
                                    reproduksi/fotokopi
                                    dan pengiriman mungkin berlaku tergantung keperluan.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4">
                                    Apa yang harus saya lakukan jika permohonan ditolak?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Jika permohonan ditolak, kami akan memberikan alasan penolakan secara tertulis. Anda
                                    dapat mengajukan banding atau negosiasi dengan PPID kami.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
