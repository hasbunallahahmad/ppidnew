{{-- resources/views/components/berita-terkini.blade.php --}}
@props(['beritaFeatured' => null, 'beritaList' => collect()])

<section class="berita-section">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Terbaru</div>
            <h2 class="section-title">Berita & <span>Informasi Terkini</span></h2>
            <p class="section-desc">Ikuti perkembangan terbaru kegiatan dan kebijakan Pemerintah Kota Semarang</p>
        </div>

        <div class="berita-layout">

            {{-- Featured News --}}
            <div class="berita-featured">
                @if ($beritaFeatured)
                    <a href="{{ route('news.post', $beritaFeatured->slug) }}" class="berita-featured-card">
                        <div class="berita-featured-img">
                            @if ($beritaFeatured->featured_image)
                                <img src="{{ $beritaFeatured->featured_image }}" alt="{{ $beritaFeatured->title }}"
                                    style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">
                            @else
                                <div class="img-placeholder img-placeholder-blue">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            @endif
                            @if ($beritaFeatured->categories->isNotEmpty())
                                <span class="berita-cat cat-pemerintahan">
                                    {{ $beritaFeatured->categories->first()->title }}
                                </span>
                            @endif
                        </div>
                        <div class="berita-featured-body">
                            <div class="berita-meta">
                                <span>
                                    <i class="fas fa-calendar"></i>
                                    {{ $beritaFeatured->published_at?->locale('id')->translatedFormat('d F Y') ?? $beritaFeatured->created_at->locale('id')->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <h2 class="berita-featured-title">{{ $beritaFeatured->title }}</h2>
                            @if ($beritaFeatured->intro)
                                <p class="berita-featured-excerpt">{{ $beritaFeatured->intro }}</p>
                            @endif
                            <span class="berita-readmore">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                @else
                    <div class="berita-featured-card"
                        style="display:flex;align-items:center;justify-content:center;
                     background:#f0f4f8;border-radius:12px;min-height:300px;color:#999;">
                        <div style="text-align:center;">
                            <i class="fas fa-newspaper"
                                style="font-size:2.5rem;margin-bottom:12px;opacity:0.3;display:block;"></i>
                            <p>Belum ada berita</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- News List --}}
            <div class="berita-list">
                @forelse($beritaList as $b)
                    <a href="{{ route('news.post', $b->slug) }}" class="berita-item">
                        <div class="berita-item-img">
                            @if ($b->card_image)
                                <img src="{{ $b->card_image }}" alt="{{ $b->title }}"
                                    style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                            @else
                                <div class="img-placeholder-sm img-ph-blue">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            @endif
                        </div>
                        <div class="berita-item-body">
                            @if ($b->categories->isNotEmpty())
                                <span class="berita-cat cat-pemerintahan">{{ $b->categories->first()->title }}</span>
                            @endif
                            <h4 class="berita-item-title">{{ $b->title }}</h4>
                            <div class="berita-item-meta">
                                <span>
                                    <i class="fas fa-calendar"></i>
                                    {{ $b->published_at?->locale('id')->translatedFormat('d M Y') ?? $b->created_at->locale('id')->translatedFormat('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div style="padding: 20px; text-align: center; color: #999; font-size: 0.9rem;">
                        Belum ada berita lainnya.
                    </div>
                @endforelse

                <a href="{{ route('news.posts') }}" class="btn btn-outline btn-block">
                    Lihat Semua Berita <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>
