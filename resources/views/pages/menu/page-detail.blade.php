@extends('layouts.menu-page')

@section('page-content')
    <section class="profile-section py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="content-box">
                    <h2>{{ $page->title }}</h2>
                    <p class="lead">{{ $page->description }}</p>

                    @if ($page->content)
                        {{-- FIX: sanitasi HTML rich text editor dengan clean() / HTMLPurifier.
                             File ini adalah template generik yang dipakai banyak halaman menu,
                             sehingga perbaikan di satu titik ini berdampak luas. --}}
                        <div class="page-content-body mt-4">
                            {!! clean($page->content) !!}
                        </div>
                    @endif

                    @if ($page->pdf_file)
                        <div class="pdf-viewer-section mt-5">
                            <div class="pdf-header mb-3">
                                <h4><i class="fas fa-file-pdf"></i> Dokumen PDF</h4>
                                <button type="button" class="btn btn-sm btn-primary"
                                    onclick="downloadPDF('{{ route('page.download-pdf', ['filename' => basename($page->pdf_file)]) }}')">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                            <div style="border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                                <iframe src="{{ Storage::disk('public')->url($page->pdf_file) }}#toolbar=1&view=FitH"
                                    width="100%" height="700px" style="display: block; border: none;" title="Dokumen PDF">
                                    <p>Browser Anda tidak mendukung tampilan PDF.
                                        <a href="{{ Storage::disk('public')->url($page->pdf_file) }}">Klik di sini untuk
                                            membuka PDF.</a>
                                    </p>
                                </iframe>
                            </div>
                        </div>

                        <script>
                            function downloadPDF(url) {
                                window.location.href = url;
                            }
                        </script>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-widget">
                    <h4>Informasi Terkait</h4>
                    <div class="related-links">
                        <ul>
                            <li><a href="/">Beranda</a></li>
                            <li><a href="/page/tentang-dinas">Tentang Dinas</a></li>
                            <li><a href="/page/visi-misi">Visi &amp; Misi</a></li>
                            <li><a href="/page/dasar-hukum">Dasar Hukum</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
