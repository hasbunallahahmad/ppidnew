@extends('layouts.app', ['title' => 'Berita & Informasi Terkini'])

@section('content')

    {{-- Page Header --}}
    <section style="background: linear-gradient(135deg, #1a3a5c 0%, #2d6a9f 100%); padding: 60px 0 40px;">
        <div class="container">
            <div style="color: white;">
                <div
                    style="font-size: 12px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;
                        color: #f0a500; margin-bottom: 12px;">
                    Informasi Terkini
                </div>
                <h1 style="font-size: 2rem; font-weight: 800; margin-bottom: 8px;">Berita & Pengumuman</h1>
                <p style="opacity: 0.8; font-size: 0.95rem;">
                    Dinas Arsip dan Perpustakaan Kota Semarang
                </p>
            </div>
        </div>
    </section>

    {{-- Berita Grid --}}
    <section style="padding: 60px 0; background: #f8f9fa;">
        <div class="container">

            @if ($posts->isEmpty())
                <div style="text-align: center; padding: 80px 20px; color: #888;">
                    <i class="fas fa-newspaper"
                        style="font-size: 3rem; margin-bottom: 16px; display: block; opacity: 0.3;"></i>
                    <p>Belum ada berita yang dipublikasikan.</p>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
                    @foreach ($posts as $post)
                        <a href="{{ route('news.post', $post->slug) }}"
                            style="text-decoration: none; color: inherit; display: flex; flex-direction: column;
                          background: white; border-radius: 12px; overflow: hidden;
                          box-shadow: 0 2px 12px rgba(0,0,0,0.07); transition: transform 0.2s, box-shadow 0.2s;"
                            onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(0,0,0,0.07)'">

                            {{-- Thumbnail --}}
                            <div
                                style="height: 200px; background: linear-gradient(135deg, #1a3a5c, #2d6a9f);
                                position: relative; overflow: hidden;">
                                @if ($post->card_image)
                                    <img src="{{ $post->card_image }}" alt="{{ $post->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                @elseif($post->featured_image)
                                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                                        <i class="fas fa-newspaper"
                                            style="font-size: 3rem; color: rgba(255,255,255,0.3);"></i>
                                    </div>
                                @endif

                                {{-- Kategori badge --}}
                                @if ($post->categories->isNotEmpty())
                                    <span
                                        style="position: absolute; top: 12px; left: 12px; background: #f0a500; color: white;
                                     font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px;
                                     text-transform: uppercase; letter-spacing: 0.5px;">
                                        {{ $post->categories->first()->title }}
                                    </span>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                                <div style="font-size: 12px; color: #888; margin-bottom: 8px; display: flex; gap: 12px;">
                                    <span><i class="fas fa-calendar" style="margin-right: 4px;"></i>
                                        {{ $post->published_at?->locale('id')->translatedFormat('d M Y') ?? $post->created_at->locale('id')->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <h3
                                    style="font-size: 1rem; font-weight: 700; color: #1a3a5c; margin-bottom: 10px;
                                   line-height: 1.4; flex: 1;">
                                    {{ $post->title }}
                                </h3>
                                @if ($post->intro)
                                    <p
                                        style="font-size: 0.875rem; color: #666; line-height: 1.6;
                                  display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $post->intro }}
                                    </p>
                                @endif
                                <div
                                    style="margin-top: 14px; font-size: 13px; font-weight: 600; color: #2d6a9f;
                                    display: flex; align-items: center; gap: 6px;">
                                    Baca Selengkapnya <i class="fas fa-arrow-right" style="font-size: 11px;"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($posts instanceof \Illuminate\Pagination\LengthAwarePaginator && $posts->hasPages())
                    <div style="margin-top: 40px; display: flex; justify-content: center;">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif

        </div>
    </section>

@endsection
