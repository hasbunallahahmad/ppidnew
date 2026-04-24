@extends('layouts.app', ['title' => $post->seo_title ?? $post->title])

@section('content')

    {{-- Hero / Header --}}
    <section style="background: linear-gradient(135deg, #1a3a5c 0%, #2d6a9f 100%); padding: 60px 0 40px;">
        <div class="container">
            {{-- Breadcrumb --}}
            <div style="font-size: 13px; color: rgba(255,255,255,0.7); margin-bottom: 16px;">
                <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Beranda</a>
                <span style="margin: 0 8px;">/</span>
                <a href="{{ route('news.posts') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Berita</a>
                <span style="margin: 0 8px;">/</span>
                <span style="color: white;">{{ Str::limit($post->title, 40) }}</span>
            </div>

            {{-- Kategori --}}
            @if ($post->categories->isNotEmpty())
                <div style="margin-bottom: 12px;">
                    @foreach ($post->categories as $cat)
                        <a href="{{ route('news.category', $cat->slug) }}"
                            style="display: inline-block; background: #f0a500; color: white; font-size: 11px;
                      font-weight: 700; padding: 4px 12px; border-radius: 20px; text-decoration: none;
                      text-transform: uppercase; letter-spacing: 0.5px; margin-right: 6px;">
                            {{ $cat->title }}
                        </a>
                    @endforeach
                </div>
            @endif

            <h1
                style="font-size: clamp(1.4rem, 3vw, 2.2rem); font-weight: 800; color: white;
                   line-height: 1.3; max-width: 800px; margin-bottom: 16px;">
                {{ $post->title }}
            </h1>

            <div style="font-size: 13px; color: rgba(255,255,255,0.75); display: flex; gap: 20px; flex-wrap: wrap;">
                <span>
                    <i class="fas fa-calendar" style="margin-right: 5px;"></i>
                    {{ $post->published_at?->locale('id')->translatedFormat('d F Y') ?? $post->created_at->locale('id')->translatedFormat('d F Y') }}
                </span>
                @if ($post->tags->isNotEmpty())
                    <span>
                        <i class="fas fa-tags" style="margin-right: 5px;"></i>
                        {{ $post->tags->pluck('title')->join(', ') }}
                    </span>
                @endif
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section style="padding: 50px 0 80px; background: #f8f9fa;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 300px; gap: 40px; align-items: start;">

                {{-- Artikel Utama --}}
                <article
                    style="background: white; border-radius: 12px; overflow: hidden;
                            box-shadow: 0 2px 12px rgba(0,0,0,0.07);">

                    {{-- Featured Image --}}
                    @if ($post->featured_image)
                        <div style="width: 100%; max-height: 460px; overflow: hidden;">
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <div style="padding: 36px;">
                        {{-- Intro / Lead --}}
                        @if ($post->intro)
                            <p
                                style="font-size: 1.1rem; color: #444; line-height: 1.7; font-weight: 500;
                               border-left: 4px solid #2d6a9f; padding-left: 16px; margin-bottom: 28px;">
                                {{ $post->intro }}
                            </p>
                        @endif

                        {{-- Konten --}}
                        <div style="font-size: 0.95rem; color: #333; line-height: 1.8;" class="news-content">
                            {!! $post->content !!}
                        </div>
                    </div>
                </article>

                {{-- Sidebar --}}
                <aside style="position: sticky; top: 20px;">

                    {{-- Berita Terkait --}}
                    <div
                        style="background: white; border-radius: 12px; padding: 24px;
                            box-shadow: 0 2px 12px rgba(0,0,0,0.07); margin-bottom: 24px;">
                        <h4
                            style="font-size: 0.9rem; font-weight: 700; color: #1a3a5c;
                               text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px;
                               padding-bottom: 12px; border-bottom: 2px solid #f0f0f0;">
                            Berita Lainnya
                        </h4>
                        @php
                            $related = \Novius\LaravelFilamentNews\Models\NewsPost::published()
                                ->where('id', '!=', $post->id)
                                ->latest('published_at')
                                ->limit(4)
                                ->get();
                        @endphp
                        @foreach ($related as $r)
                            <a href="{{ route('news.post', $r->slug) }}"
                                style="display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f5f5f5;
                              text-decoration: none; color: inherit;"
                                onmouseover="this.querySelector('h5').style.color='#2d6a9f'"
                                onmouseout="this.querySelector('h5').style.color='#1a3a5c'">
                                <div
                                    style="width: 60px; height: 60px; flex-shrink: 0; border-radius: 8px; overflow: hidden;
                                    background: linear-gradient(135deg, #1a3a5c, #2d6a9f);">
                                    @if ($r->card_image)
                                        <img src="{{ $r->card_image }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <div style="display:flex;align-items:center;justify-content:center;height:100%;">
                                            <i class="fas fa-newspaper"
                                                style="color:rgba(255,255,255,0.4);font-size:1.2rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h5
                                        style="font-size: 0.82rem; font-weight: 600; color: #1a3a5c;
                                       line-height: 1.4; margin-bottom: 4px; transition: color 0.2s;
                                       display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $r->title }}
                                    </h5>
                                    <span style="font-size: 11px; color: #999;">
                                        {{ $r->published_at?->locale('id')->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Kembali ke daftar --}}
                    <a href="{{ route('news.posts') }}"
                        style="display: block; background: #1a3a5c; color: white; text-align: center;
                          padding: 14px; border-radius: 10px; text-decoration: none; font-weight: 600;
                          font-size: 14px; transition: background 0.2s;"
                        onmouseover="this.style.background='#2d6a9f'" onmouseout="this.style.background='#1a3a5c'">
                        <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
                        Semua Berita
                    </a>
                </aside>

            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .news-content img {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
                margin: 16px 0;
            }

            .news-content h2,
            .news-content h3 {
                color: #1a3a5c;
                margin: 24px 0 12px;
                font-weight: 700;
            }

            .news-content p {
                margin-bottom: 16px;
            }

            .news-content ul,
            .news-content ol {
                padding-left: 20px;
                margin-bottom: 16px;
            }

            .news-content a {
                color: #2d6a9f;
            }

            .news-content blockquote {
                border-left: 4px solid #2d6a9f;
                padding-left: 16px;
                color: #555;
                font-style: italic;
            }
        </style>
    @endpush

@endsection
