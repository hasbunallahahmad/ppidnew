@extends('layouts.menu-page')

@section('page-content')
    @php
        $structured = is_array($page->structured_content)
            ? $page->structured_content
            : json_decode($page->structured_content ?? '{}', true);

        $intro = $structured['intro'] ?? '';
        $sections = $structured['sections'] ?? [];
    @endphp
    <div class="ism-page-layout">
        <div class="ism-wrapper">

            {{-- Intro --}}
            @if ($intro)
                <div class="ism-intro">
                    <div class="ism-intro-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <p>{{ $intro }}</p>
                </div>
            @endif

            {{-- Sections --}}
            @foreach ($sections as $section)
                <div class="ism-section">
                    <div class="ism-section-header">
                        <h3>{{ $section['title'] }}</h3>
                    </div>
                    <div class="ism-section-body">
                        @forelse ($section['items'] ?? [] as $index => $item)
                            @php
                                // FIX: ganti javascript:void(0) dengan pola @if/@else yang aman.
                                // javascript:void(0) melanggar CSP dan merupakan pola lama.
                                // URL dari JSON admin divalidasi dengan safe_url() terlebih dulu.
                                $hasUrl    = $item['url'] !== '#';
                                $safeUrl   = $hasUrl ? safe_url($item['url']) : '#';
                                $stillSafe = $safeUrl !== '#'; // safe_url() mungkin reject URL berbahaya
                            @endphp

                            @if ($stillSafe)
                                <a href="{{ $safeUrl }}"
                                    class="ism-item"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    <span class="ism-item-number">{{ $index + 1 }}</span>
                                    <span class="ism-item-label">{{ $item['label'] }}</span>
                                    <svg class="ism-item-arrow" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </a>
                            @else
                                {{-- FIX: gunakan <span> bukan <a href="javascript:void(0)"> untuk item belum tersedia --}}
                                <span class="ism-item ism-item--unavailable">
                                    <span class="ism-item-number">{{ $index + 1 }}</span>
                                    <span class="ism-item-label">{{ $item['label'] }}</span>
                                    <span class="ism-item-badge">Segera Hadir</span>
                                </span>
                            @endif
                        @empty
                            <p class="ism-empty">Belum ada informasi.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach

        </div>
        <div class="ism-sidebar">
            <div class="ism-sidebar-widget">
                <h4>Navigasi Informasi Publik</h4>
                <ul>
                    <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Beranda</a></li>
                    <li><a href="{{ url('/page/informasi-setiap-saat') }}"><i class="fas fa-clock"></i> Informasi Setiap
                            Saat</a></li>
                    <li><a href="{{ url('/page/informasi-berkala') }}"><i class="fas fa-calendar-alt"></i> Informasi
                            Berkala</a>
                    </li>
                    <li><a href="{{ url('/page/informasi-dikecualikan') }}"><i class="fas fa-lock"></i> Informasi
                            Dikecualikan</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
