@extends('layouts.menu-page')

@section('page-content')
    <div class="ism-page-layout">

        {{-- Konten Utama --}}
        <div>
            {{-- Intro --}}
            <div class="ism-intro" style="margin-bottom: 1.75rem;">
                <div class="ism-intro-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <p>{{ $page->description ?? 'Informasi yang dikecualikan dari akses publik sesuai ketentuan peraturan perundang-undangan yang berlaku.' }}
                </p>
            </div>

            {{-- PDF Viewer --}}
            <div class="ism-section">
                <div class="ism-section-header">
                    <h3>SK Daftar Informasi Dikecualikan</h3>
                </div>
                <div style="padding: 0;">
                    @if (!empty($page->pdf_file))
                        <div class="pdf-viewer-section"
                            style="border-radius: 0 0 10px 10px; border: 1px solid #e5e7eb; border-top: none;">
                            <div class="pdf-header" style="padding: 12px 16px;">
                                <h4 style="font-size: 0.85rem;">
                                    <i class="fas fa-file-pdf"></i>
                                    SK Daftar Informasi Dikecualikan
                                </h4>
                                <a href="{{ asset('storage/' . $page->pdf_file) }}" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i> Unduh PDF
                                </a>
                            </div>
                            <iframe src="{{ asset('storage/' . $page->pdf_file) }}" width="100%" height="600"
                                style="display: block; border: none;"></iframe>
                        </div>
                    @else
                        <div
                            style="padding: 40px 20px; text-align: center; background: #f9fafb; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 10px 10px;">
                            <div
                                style="width: 56px; height: 56px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <i class="fas fa-file-pdf" style="font-size: 1.4rem; color: #d1d5db;"></i>
                            </div>
                            <p style="font-size: 0.875rem; color: #9ca3af; margin: 0 0 4px; font-weight: 600;">Dokumen belum
                                tersedia</p>
                            <p style="font-size: 0.8rem; color: #d1d5db; margin: 0;">SK akan ditampilkan di sini setelah
                                diunggah</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="ism-sidebar">
            <div class="ism-sidebar-widget">
                <h4>Navigasi Informasi Publik</h4>
                <ul>
                    <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Beranda</a></li>
                    <li><a href="{{ url('/page/informasi-setiap-saat') }}"><i class="fas fa-clock"></i> Informasi Setiap
                            Saat</a></li>
                    <li><a href="{{ url('/page/informasi-berkala') }}"><i class="fas fa-calendar-alt"></i> Informasi
                            Berkala</a></li>
                    <li><a href="{{ url('/page/informasi-serta-merta') }}"><i class="fas fa-bolt"></i> Informasi Serta
                            Merta</a></li>
                </ul>
            </div>
        </div>

    </div>
@endsection
