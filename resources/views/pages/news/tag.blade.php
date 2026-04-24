@extends('layouts.app', ['title' => 'Tag: ' . $tag->title])

@section('content')

    <section style="background: linear-gradient(135deg, #1a3a5c 0%, #2d6a9f 100%); padding: 60px 0 40px;">
        <div class="container">
            <div
                style="font-size: 12px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;
                    color: #f0a500; margin-bottom: 8px;">
                Tag</div>
            <h1 style="font-size: 2rem; font-weight: 800; color: white;"># {{ $tag->title }}</h1>
        </div>
    </section>

    <section style="padding: 60px 0; background: #f8f9fa;">
        <div class="container">
            @if ($posts->isEmpty())
                <div style="text-align: center; padding: 80px 20px; color: #888;">
                    <p>Belum ada berita dengan tag ini.</p>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
                    @foreach ($posts as $post)
                        <a href="{{ route('news.post', $post->slug) }}"
                            style="text-decoration: none; color: inherit; background: white; border-radius: 12px;
                          overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.07); display: flex;
                          flex-direction: column; transition: transform 0.2s;"
                            onmouseover="this.style.transform='translateY(-4px)'"
                            onmouseout="this.style.transform='translateY(0)'">
                            <div
                                style="height: 180px; background: linear-gradient(135deg, #1a3a5c, #2d6a9f); overflow: hidden;">
                                @if ($post->card_image)
                                    <img src="{{ $post->card_image }}" style="width:100%;height:100%;object-fit:cover;">
                                @endif
                            </div>
                            <div style="padding: 18px;">
                                <h3 style="font-size: 0.95rem; font-weight: 700; color: #1a3a5c; line-height: 1.4;">
                                    {{ $post->title }}
                                </h3>
                                <div style="margin-top: 12px; font-size: 13px; font-weight: 600; color: #2d6a9f;">
                                    Baca <i class="fas fa-arrow-right" style="font-size: 11px;"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection
