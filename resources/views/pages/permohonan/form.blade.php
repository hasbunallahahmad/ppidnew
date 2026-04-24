@extends('layouts.menu-page')

@push('styles')
    <style>
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        /* FORM PERMOHONAN STYLING */
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

        .permohonan-form-section {
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

        /* Alert Style */
        .alert-info {
            background: linear-gradient(135deg, #e7f3ff 0%, #f0f8ff 100%);
            border-left: 4px solid var(--primary-light);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            margin-top: 24px;
            margin-bottom: 30px;
            color: var(--text-dark);
        }

        .alert-info strong {
            color: var(--primary);
        }

        /* Form Sections */
        .form-section {
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--border);
        }

        .form-section:last-of-type {
            border-bottom: none;
            padding-bottom: 0;
        }

        .section-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--accent);
        }

        .section-title i {
            color: var(--accent);
            font-size: 1.3rem;
        }

        /* Form Labels */
        .form-label {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 8px;
            display: block;
        }

        .text-danger {
            color: var(--red) !important;
            font-weight: 600;
        }

        /* Form Controls */
        .form-control,
        .form-select {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            font-size: 0.95rem;
            font-family: inherit;
            background-color: #ffffff;
            color: var(--text-body);
            transition: all 0.3s ease;
        }

        .form-control::placeholder,
        .form-select::placeholder {
            color: var(--text-light);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-light);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(26, 111, 204, 0.1);
            outline: none;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: var(--red);
            background-color: #fff5f5;
            background-image: none;
            padding-right: 14px;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(214, 48, 49, 0.1);
        }

        .form-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 6px;
            display: block;
        }

        .invalid-feedback {
            color: var(--red);
            font-size: 0.85rem;
            margin-top: 6px;
            display: block !important;
        }

        /* Row Spacing */
        .row {
            margin-left: -12px;
            margin-right: -12px;
        }

        .row>[class*="col-"] {
            padding-left: 12px;
            padding-right: 12px;
        }

        .mb-3 {
            margin-bottom: 24px;
        }

        /* Buttons */
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
            border: none;
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

        .g-3>* {
            padding-left: 12px;
            padding-right: 12px;
        }

        .pt-4 {
            padding-top: 28px !important;
        }

        .border-top {
            border-top: 1px solid var(--border) !important;
        }

        /* Sidebar */
        .sidebar-widget {
            background: var(--bg-light);
            padding: 24px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .sidebar-widget:hover {
            box-shadow: var(--shadow-sm);
        }

        .sidebar-widget h4 {
            color: var(--primary);
            margin-bottom: 16px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar-widget h4 i {
            color: var(--accent);
            font-size: 1.1rem;
        }

        .checklist-item {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
        }

        .checklist-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: not-allowed;
            accent-color: var(--primary-light);
            border-radius: 3px;
        }

        .checklist-item label {
            margin-bottom: 0;
            color: var(--text-body);
            cursor: not-allowed;
            user-select: none;
            font-size: 0.95rem;
        }

        .tips-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .tips-list li {
            margin-bottom: 12px;
            padding-left: 24px;
            position: relative;
            color: var(--text-body);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .tips-list li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--green);
            font-weight: bold;
        }

        .sidebar-widget p {
            color: var(--text-body);
            margin-bottom: 12px;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .sidebar-widget a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .sidebar-widget a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        /* Section Layout */
        .permohonan-form-section .row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            align-items: start;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .permohonan-form-section .row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .content-box {
                padding: 30px;
            }

            .content-box h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .permohonan-form-section {
                padding: 20px 0 !important;
            }

            .content-box {
                padding: 20px;
                border-radius: var(--radius-sm);
            }

            .form-section {
                margin-bottom: 24px;
                padding-bottom: 24px;
            }

            .row {
                margin-left: -8px;
                margin-right: -8px;
            }

            .row>[class*="col-"] {
                padding-left: 8px;
                padding-right: 8px;
            }

            .btn {
                font-size: 0.9rem;
                padding: 10px 18px;
            }

            .btn-lg {
                padding: 11px 22px;
                font-size: 0.95rem;
            }

            .g-3>* {
                padding-left: 8px;
                padding-right: 8px;
            }
        }

        @media (max-width: 576px) {
            .content-box {
                padding: 16px;
            }

            .section-title {
                font-size: 1rem;
            }

            .sidebar-widget {
                padding: 18px;
            }

            .form-control,
            .form-select {
                font-size: 16px;
                /* Prevents zoom on iOS */
            }
        }
    </style>
@endpush

@section('page-content')
    <section class="permohonan-form-section">
        <div class="row">
            <div>
                <div class="content-box">
                    <h2>{{ $pageTitle }}</h2>
                    <p class="lead">{{ $pageDescription }}</p>

                    <div class="alert alert-info mt-4" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Perhatian:</strong> Semua kolom yang ditandai dengan <span class="text-danger">*</span>
                        harus
                        diisi.
                    </div>

                    <form action="{{ route('permohonan.store') }}" method="POST" novalidate class="needs-validation">
                        @csrf

                        <!-- DATA DIRI PEMOHON -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-user me-2 text-primary"></i> Data Diri Pemohon
                            </h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_pemohon" class="form-label">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_pemohon') is-invalid @enderror"
                                        id="nama_pemohon" name="nama_pemohon" value="{{ old('nama_pemohon') }}"
                                        placeholder="Masukkan nama lengkap Anda" minlength="3" maxlength="255"
                                        pattern="[a-zA-Z\s\.\-'éèêëàâäùûüôöœçñ]+" required>
                                    <small class="form-text">Minimal 3 karakter, tanpa angka atau simbol khusus</small>
                                    @error('nama_pemohon')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="contoh@email.com" maxlength="255" required>
                                    <small class="form-text">Format: yourname@domain.com (email yang aktif sangat
                                        penting)</small>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="no_telepon" class="form-label">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('no_telepon') is-invalid @enderror"
                                        id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                        placeholder="08xx xxxx xxxx atau +62xxx" pattern="(\+62|0)[0-9]{9,12}"
                                        minlength="10" maxlength="15" required>
                                    <small class="form-text">Gunakan format: 08xx xxxx xxxx atau +62xxx xxxx xxxx</small>
                                    @error('no_telepon')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jenis_identitas" class="form-label">Jenis Identitas <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('jenis_identitas') is-invalid @enderror"
                                        id="jenis_identitas" name="jenis_identitas" required>
                                        <option value="" selected disabled>-- Pilih jenis identitas --</option>
                                        <option value="KTP" {{ old('jenis_identitas') == 'KTP' ? 'selected' : '' }}>KTP
                                        </option>
                                        <option value="SIM" {{ old('jenis_identitas') == 'SIM' ? 'selected' : '' }}>SIM
                                        </option>
                                        <option value="Paspor" {{ old('jenis_identitas') == 'Paspor' ? 'selected' : '' }}>
                                            Paspor</option>
                                        <option value="KITAS" {{ old('jenis_identitas') == 'KITAS' ? 'selected' : '' }}>
                                            KITAS</option>
                                        <option value="Surat Keterangan Lainnya"
                                            {{ old('jenis_identitas') == 'Surat Keterangan Lainnya' ? 'selected' : '' }}>
                                            Surat Keterangan Lainnya</option>
                                    </select>
                                    <small class="form-text">Pilih jenis identitas yang Anda gunakan</small>
                                    @error('jenis_identitas')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="no_identitas" class="form-label">Nomor Identitas <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('no_identitas') is-invalid @enderror"
                                        id="no_identitas" name="no_identitas" value="{{ old('no_identitas') }}"
                                        placeholder="Masukkan nomor identitas (contoh: 3273012345678901)" minlength="5"
                                        maxlength="20" pattern="[0-9]+" inputmode="numeric" required>
                                    <small class="form-text">5-20 digit numeric (hanya angka)</small>
                                    @error('no_identitas')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                    minlength="10" maxlength="500"
                                    placeholder="Masukkan alamat lengkap Anda (jalan, nomor, kelurahan, kecamatan, kota, provinsi, kode pos)" required>{{ old('alamat') }}</textarea>
                                <small class="form-text">Minimal 10 karakter, maksimal 500 karakter. Harus lengkap dengan
                                    RT/RW, jalan, kelurahan, kecamatan, kota, provinsi, dan kode pos</small>
                                @error('alamat')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- DATA PERMOHONAN -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-file-alt me-2 text-primary"></i> Data Permohonan
                            </h4>

                            <div class="mb-3">
                                <label for="informasi_diminta" class="form-label">Informasi yang Diminta <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('informasi_diminta') is-invalid @enderror" id="informasi_diminta"
                                    name="informasi_diminta" rows="4" minlength="10" maxlength="2000"
                                    placeholder="Jelaskan dengan detail dan spesifik informasi apa yang Anda butuhkan..." required>{{ old('informasi_diminta') }}</textarea>
                                <small class="form-text">Minimal 10 karakter, maksimal 2000 karakter. Semakin detail Anda
                                    menjelaskan, semakin mudah kami menemukan informasi yang Anda cari. <span
                                        class="char-count" data-target="informasi_diminta">0</span>/2000</small>
                                @error('informasi_diminta')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tujuan_penggunaan" class="form-label">Tujuan Penggunaan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('tujuan_penggunaan') is-invalid @enderror" id="tujuan_penggunaan"
                                    name="tujuan_penggunaan" rows="3" minlength="5" maxlength="500"
                                    placeholder="Contoh: kepentingan pribadi, riset, bisnis, pendidikan, jurnalistik, dsb." required>{{ old('tujuan_penggunaan') }}</textarea>
                                <small class="form-text">Minimal 5 karakter, maksimal 500 karakter. Jelaskan tujuan Anda
                                    dengan jelas. <span class="char-count"
                                        data-target="tujuan_penggunaan">0</span>/500</small>
                                @error('tujuan_penggunaan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cara_mendapatkan" class="form-label">Cara Mendapatkan Informasi <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('cara_mendapatkan') is-invalid @enderror"
                                    id="cara_mendapatkan" name="cara_mendapatkan" required>
                                    <option value="" selected disabled>-- Pilih cara memperoleh informasi --</option>
                                    <option value="Pengambilan Langsung"
                                        {{ old('cara_mendapatkan') == 'Pengambilan Langsung' ? 'selected' : '' }}>
                                        Pengambilan Langsung (di kantor kami)
                                    </option>
                                    <option value="Dimulai via Email"
                                        {{ old('cara_mendapatkan') == 'Dimulai via Email' ? 'selected' : '' }}>
                                        Dimulai via Email
                                    </option>
                                </select>
                                <small class="form-text">Pilih metode yang paling sesuai untuk Anda</small>
                                @error('cara_mendapatkan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- TOMBOL ACTION -->
                        <div class="form-section border-top pt-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Permohonan
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('permohonan.care') }}"
                                        class="btn btn-outline-secondary btn-lg w-100">
                                        <i class="fas fa-times me-2"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SIDEBAR -->
            <div>
                <div class="sidebar-widget">
                    <h4>
                        <i class="fas fa-clipboard-check me-2"></i> Checklist Sebelum Kirim
                    </h4>
                    <div class="checklist">
                        <div class="checklist-item">
                            <input type="checkbox" id="check1" disabled>
                            <label for="check1">Data diri sudah lengkap</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="check2" disabled>
                            <label for="check2">Email dan nomor telepon aktif</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="check3" disabled>
                            <label for="check3">Informasi diminta jelas dan spesifik</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="check4" disabled>
                            <label for="check4">Tujuan penggunaan terisi</label>
                        </div>
                        <div class="checklist-item">
                            <input type="checkbox" id="check5" disabled>
                            <label for="check5">Cara memperoleh informasi sudah dipilih</label>
                        </div>
                    </div>
                </div>

                <div class="sidebar-widget mt-4 ml-25px pl-2">
                    <h4>
                        <i class="fas fa-lightbulb me-2"></i> Tips & Trik
                    </h4>
                    <ul class="tips-list">
                        <li>Jelaskan informasi yang Anda butuhkan dengan sesederhana dan sejelasifik mungkin</li>
                        <li>Gunakan nomor identitas yang masih berlaku</li>
                        <li>Email yang Anda berikan harus aktif dan sering Anda buka</li>
                        <li>Jika permohonan ditolak, kami akan memberikan alasan yang jelas</li>
                    </ul>
                </div>

                <div class="sidebar-widget mt-4 ml-25px pl-10">
                    <h4>
                        <i class="fas fa-question-circle me-2"></i> Hubungi Support
                    </h4>
                    <p>Ada pertanyaan? Hubungi kami:</p>
                    <p class="mb-2">
                        <i class="fas fa-envelope me-2 text-primary pl-5"></i>
                        <a>umpegarpusda116@gmail.com</a>
                    </p>
                    <p>
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <a href="https://api.whatsapp.com/send?phone=6281222233860&text=Halo%20Dinas%20Arpus%20Kota%20Semarang,%20saya%20mau%20bertanya"
                            target="_blank">Whatsapp
                            Kami</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            // ━━━━ CHARACTER COUNTER ━━━━
            const textareas = document.querySelectorAll('textarea[maxlength]');
            textareas.forEach(textarea => {
                const target = textarea.getAttribute('id');
                const counter = document.querySelector(`.char-count[data-target="${target}"]`);

                if (counter) {
                    // Update on input
                    textarea.addEventListener('input', function() {
                        counter.textContent = this.value.length;
                    });

                    // Initialize counter
                    counter.textContent = textarea.value.length;
                }
            });

            // ━━━━ REAL-TIME VALIDATION ━━━━

            // Nama Pemohon - Hanya huruf dan spasi
            const namaPemohon = document.getElementById('nama_pemohon');
            namaPemohon?.addEventListener('input', function() {
                this.value = this.value.replace(/[0-9!@#$%^&*()_+=\[\]{};':"\\|,.<>\/?]/g, '');
            });

            // Nomor Telepon - Hanya angka, +, 0
            const noTelepon = document.getElementById('no_telepon');
            noTelepon?.addEventListener('input', function() {
                this.value = this.value.replace(/[^\d+0]/g, '');
            });

            // Nomor Identitas - Hanya numeric
            const noIdentitas = document.getElementById('no_identitas');
            noIdentitas?.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // Email - Lowercase only
            const email = document.getElementById('email');
            email?.addEventListener('blur', function() {
                this.value = this.value.toLowerCase().trim();
            });

            // Trim on blur untuk semua text inputs
            document.querySelectorAll('input[type="text"], textarea').forEach(field => {
                field?.addEventListener('blur', function() {
                    this.value = this.value.trim();
                });
            });

            // ━━━━ FORM SUBMISSION VALIDATION ━━━━
            form?.addEventListener('submit', function(e) {
                if (form.checkValidity() === false) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                // Custom validation untuk phone number format
                const phoneRegex = /^(\+62|0)[0-9]{9,12}$/;
                if (noTelepon && !phoneRegex.test(noTelepon.value.replace(/\s/g, ''))) {
                    noTelepon.classList.add('is-invalid');
                    e.preventDefault();
                    e.stopPropagation();
                }

                // Custom validation untuk nama (minimal 3 karakter, hanya huruf)
                const nameRegex = /^[a-zA-Z\s\.\-'éèêëàâäùûüôöœçñ]{3,}$/;
                if (namaPemohon && !nameRegex.test(namaPemohon.value)) {
                    namaPemohon.classList.add('is-invalid');
                    e.preventDefault();
                    e.stopPropagation();
                }

                form.classList.add('was-validated');
            });

            // ━━━━ REAL-TIME PATTERN VALIDATION ━━━━

            // Remove is-invalid class saat user mulai mengetik
            const formInputs = form?.querySelectorAll('input, textarea, select');
            formInputs?.forEach(input => {
                input?.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });

                input?.addEventListener('change', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // ━━━━ HELPER: Show validation state ━━━━
            const inputs = form?.querySelectorAll('input[required], textarea[required], select[required]');
            inputs?.forEach(input => {
                input?.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.classList.add('is-invalid');
                    } else {
                        // Basic HTML5 validation
                        if (!this.checkValidity()) {
                            this.classList.add('is-invalid');
                        } else {
                            this.classList.remove('is-invalid');
                        }
                    }
                });

                input?.addEventListener('focus', function() {
                    if (this.value.trim() !== '' && this.checkValidity()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // ━━━━ PREVENT FORM SPAM ━━━━
            let isSubmitting = false;
            form?.addEventListener('submit', function(e) {
                if (isSubmitting) {
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }

                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn && form.checkValidity()) {
                    isSubmitting = true;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...';
                }
            });
        });
    </script>

    <style>
        /* Character Counter Styling */
        .char-count {
            color: var(--primary-light);
            font-weight: 600;
        }

        /* Highlight when approaching max length */
        textarea:invalid {
            border-color: var(--red);
        }

        /* Success state */
        input:valid:not([value=""]),
        textarea:valid:not([value=""]),
        select:valid:not([value=""]) {
            border-color: var(--green);
            background-color: #f0fdf4;
        }

        /* Disabled submit button styling */
        button[type="submit"]:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
@endpush
