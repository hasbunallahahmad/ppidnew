@extends('layouts.menu-page')

@section('page-content')
    <section class="generic-page-section py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="content-box">
                    <h2>{{ $pageTitle }}</h2>
                    <p class="lead">{{ $pageDescription }}</p>

                    <div class="page-body">
                        <p>Konten halaman {{ $pageTitle }} akan ditampilkan di sini. Anda dapat menambahkan data dari
                            database atau menyesuaikan tampilan sesuai kebutuhan.</p>

                        <h3>Fitur-Fitur</h3>
                        <ul>
                            <li>Informasi lengkap dan terstruktur</li>
                            <li>Mudah diupdate melalui admin panel</li>
                            <li>Responsif di semua perangkat</li>
                            <li>Optimasi SEO</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-widget">
                    <h4>Informasi Terkait</h4>
                    <nav class="related-links">
                        <ul>
                            <li><a href="{{ route('page.tentang-dinas') }}">Tentang Dinas</a></li>
                            <li><a href="{{ route('page.visi-misi') }}">Visi & Misi</a></li>
                            <li><a href="{{ route('page.dasar-hukum') }}">Dasar Hukum</a></li>
                            <li><a href="{{ route('page.profil-ppid') }}">Profil PPID</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
