@extends('layouts.menu-page')

@section('page-content')
    <section class="permohonan-section">
        <div class="row">
            <div class="content-box">
                <h2>{{ $pageTitle }}</h2>
                <p class="lead">{{ $pageDescription }}</p>

                <!-- Langkah-Langkah Pengajuan -->
                <div class="steps-container mt-5">
                    <div class="step-item mb-4">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Siapkan Data Diri Anda</h4>
                            <p>Pastikan Anda memiliki data berikut:</p>
                            <ul class="list-unstyled ms-3">
                                <li><i class="fas fa-check text-success me-2"></i> Nama lengkap</li>
                                <li><i class="fas fa-check text-success me-2"></i> Email aktif</li>
                                <li><i class="fas fa-check text-success me-2"></i> Nomor telepon</li>
                                <li><i class="fas fa-check text-success me-2"></i> Alamat lengkap</li>
                                <li><i class="fas fa-check text-success me-2"></i> Nomor identitas (KTP/SIM/Paspor)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="step-item mb-4">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Tentukan Informasi yang Diminta</h4>
                            <p>Jelaskan dengan detail dan spesifik informasi apa yang Anda butuhkan. Semakin detail
                                penjelasan Anda, semakin mudah kami menemukan informasi yang Anda cari.</p>
                        </div>
                    </div>

                    <div class="step-item mb-4">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Tentukan Tujuan Penggunaan</h4>
                            <p>Sebutkan tujuan Anda mengajukan permohonan informasi ini (kepentingan pribadi, riset,
                                bisnis, dsb).</p>
                        </div>
                    </div>

                    <div class="step-item mb-4">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Pilih Cara Mendapatkan Informasi</h4>
                            <p>Pilih salah satu cara yang paling sesuai dengan kebutuhan Anda:</p>
                            <ul class="list-unstyled ms-3">
                                <li><i class="fas fa-arrow-right me-2"></i> <strong>Pengambilan Langsung</strong> -
                                    Ambil langsung di kantor kami</li>
                                <li><i class="fas fa-arrow-right me-2"></i> <strong>Dikirim via Email</strong> - Dikirim
                                    ke email Anda</li>
                                {{-- <li><i class="fas fa-arrow-right me-2"></i> <strong>Faksimili</strong> - Dikirim via
                                    faks</li>
                                <li><i class="fas fa-arrow-right me-2"></i> <strong>Pos</strong> - Dikirim via pos</li> --}}
                            </ul>
                        </div>
                    </div>

                    <div class="step-item mb-4">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <h4>Isi Formulir Permohonan</h4>
                            <p>Isilah semua kolom yang dipersyaratkan dalam formulir permohonan secara lengkap dan
                                akurat.</p>
                        </div>
                    </div>

                    <div class="step-item mb-4">
                        <div class="step-number">6</div>
                        <div class="step-content">
                            <h4>Kirimkan Permohonan</h4>
                            <p>Tekan tombol "Kirim Permohonan". Anda akan mendapatkan nomor tiket untuk melacak status
                                permohonan Anda.</p>
                        </div>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="alert alert-info mt-5" role="alert">
                    <h5 class="alert-heading">📋 Informasi Penting</h5>
                    <ul class="mb-0">
                        <li>Waktu respons permohonan adalah <strong>10 hari kerja</strong> sejak permohonan diterima.
                        </li>
                        <li>Kami akan menghubungi Anda melalui email atau telepon jika ada informasi tambahan yang
                            diperlukan.</li>
                        <li>Anda dapat melacak status permohonan menggunakan nomor tiket yang diberikan.</li>
                        <li>Informasi yang diminta mungkin dikenakan biaya sesuai dengan peraturan yang berlaku.</li>
                    </ul>
                </div>

                <!-- Button Aksi -->
                <div class="action-buttons mt-5 pt-4 border-top">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('permohonan.form') }}" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-edit me-2"></i> Buat Permohonan Baru
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <div class="sidebar-widget">
                <h4>
                    <i class="fas fa-question-circle me-2"></i> Pertanyaan Umum
                </h4>
                <nav class="related-links">
                    <ul>
                        <li>
                            <a href="#" class="faq-link">Apa itu PPID?</a>
                        </li>
                        <li>
                            <a href="#" class="faq-link">Siapa yang bisa mengajukan permohonan?</a>
                        </li>
                        <li>
                            <a href="#" class="faq-link">Berapa lama proses permohonan?</a>
                        </li>
                        <li>
                            <a href="#" class="faq-link">Bagaimana cara cek status permohonan?</a>
                        </li>
                        <li>
                            <a href="#" class="faq-link">Apakah ada biaya permohonan?</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="sidebar-widget mt-4">
                <h4>
                    <i class="fas fa-phone me-2"></i> Hubungi Kami
                </h4>
                <div class="contact-info">
                    <p><strong>Jam Kerja:</strong><br>Senin - Jumat, 08:00 - 16:00 WIB</p>
                    <p><strong>Email:</strong><br><a href="mailto:ppid@dinas.go.id">ppid@dinas.go.id</a></p>
                    <p><strong>Telepon:</strong><br><a href="tel:+6212345678">+62 (123) 456-7890</a></p>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
