{{-- resources/views/components/footer.blade.php --}}
@php
    $footerSetting = \App\Models\FooterSetting::settings();
@endphp
<footer class="site-footer" data-brand-name="{{ $footerSetting->brand_name }}"
    data-contact-phone="{{ $footerSetting->contact_phone }}" data-contact-email="{{ $footerSetting->contact_email }}"
    data-contact-address="{{ $footerSetting->contact_address }}">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">

                {{-- Brand --}}
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $footerSetting->brand_name }}"
                                style="height: 48px; width: auto;">
                        </div>
                        <div>
                            <span class="footer-logo-name">{{ $footerSetting->brand_name }}</span>
                            <span class="footer-logo-sub">Dinas Arsip & Perpustakaan Kota Semarang</span>
                        </div>
                    </div>
                    <p class="footer-tagline">{{ $footerSetting->tagline }}</p>
                    <div class="footer-socials">
                        @if ($footerSetting->social_facebook && $footerSetting->social_facebook !== '#')
                            <a href="{{ $footerSetting->social_facebook }}" class="social-btn" title="Facebook"
                                target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if ($footerSetting->social_instagram && $footerSetting->social_instagram !== '#')
                            <a href="{{ $footerSetting->social_instagram }}" class="social-btn" title="Instagram"
                                target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if ($footerSetting->social_youtube && $footerSetting->social_youtube !== '#')
                            <a href="{{ $footerSetting->social_youtube }}" class="social-btn" title="YouTube"
                                target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if ($footerSetting->social_twitter && $footerSetting->social_twitter !== '#')
                            <a href="{{ $footerSetting->social_twitter }}" class="social-btn" title="Twitter/X"
                                target="_blank" rel="noopener noreferrer"><i class="fab fa-x-twitter"></i></a>
                        @endif
                    </div>
                    <div class="footer-cert">
                        @if ($footerSetting->cert_1_text)
                            <span class="cert-badge"><i
                                    class="{{ $footerSetting->cert_1_icon ?? 'fas fa-award' }}"></i>
                                {{ $footerSetting->cert_1_text }}</span>
                        @endif
                        @if ($footerSetting->cert_2_text)
                            <span class="cert-badge"><i
                                    class="{{ $footerSetting->cert_2_icon ?? 'fas fa-shield-alt' }}"></i>
                                {{ $footerSetting->cert_2_text }}</span>
                        @endif
                    </div>
                </div>

                {{-- Layanan Kearsipan --}}
                <div class="footer-col">
                    <h4>Layanan Kearsipan</h4>
                    <ul>
                        <x-footer-menu-items :section="'footer_section_1'" />
                    </ul>
                </div>

                {{-- Layanan Perpustakaan --}}
                <div class="footer-col">
                    <h4>Layanan Perpustakaan</h4>
                    <ul>
                        <x-footer-menu-items :section="'footer_section_2'" />
                    </ul>
                </div>

                {{-- Kontak --}}
                <div class="footer-col">
                    <h4>Kontak & Lokasi</h4>
                    <div class="footer-contacts">
                        @if ($footerSetting->contact_address)
                            <div class="footer-contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $footerSetting->contact_address }}</span>
                            </div>
                        @endif
                        @if ($footerSetting->contact_phone)
                            <div class="footer-contact-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $footerSetting->contact_phone }}</span>
                            </div>
                        @endif
                        @if ($footerSetting->contact_fax)
                            <div class="footer-contact-item">
                                <i class="fas fa-fax"></i>
                                <span>{{ $footerSetting->contact_fax }}</span>
                            </div>
                        @endif
                        @if ($footerSetting->contact_email)
                            <div class="footer-contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $footerSetting->contact_email }}</span>
                            </div>
                        @endif
                        @if ($footerSetting->contact_hours)
                            <div class="footer-contact-item">
                                <i class="fas fa-clock"></i>
                                <span>{!! nl2br(e($footerSetting->contact_hours)) !!}</span>
                            </div>
                        @endif
                    </div>
                    <a href="http://wa.me/6281222233860" target="_blank" class="btn btn-primary btn-sm"
                        style="margin-top: 1rem;">
                        <i class="fas fa-headset"></i> Hubungi Kami
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>{{ $footerSetting->footer_copyright }}</p>
            <div class="footer-bottom-links">
                @php
                    use NoteBrainsLab\FilamentMenuManager\Models\Menu;
                    $footerMenu = Menu::query()
                        ->whereHas('location', function ($query) {
                            $query->where('handle', 'footer_section_3');
                        })
                        ->with([
                            'items' => function ($query) {
                                $query->whereNull('parent_id')->orderBy('order')->with('children');
                            },
                        ])
                        ->first();
                @endphp

                @if ($footerMenu?->items)
                    @foreach ($footerMenu->items as $item)
                        <a href="{{ $item->url }}">{{ $item->title }}</a>
                    @endforeach
                @else
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat Penggunaan</a>
                    <a href="#">Aksesibilitas</a>
                    <a href="#">Peta Situs</a>
                @endif
            </div>
        </div>
    </div>
</footer>
