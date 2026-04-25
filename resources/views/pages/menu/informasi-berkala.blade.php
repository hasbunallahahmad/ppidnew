@extends('layouts.menu-page')

@section('page-content')
    <div class="row">
        <div class="col-lg-8">
            <div class="content-box">
                <h2>{{ $page->title }}</h2>

                @if ($page->description)
                    <p class="lead">{{ $page->description }}</p>
                @endif

                {{-- Render dari structured_content (JSON) --}}
                @if (!empty($page->structured_content['sections']))
                    <div class="info-periodic mt-4">
                        @foreach ($page->structured_content['sections'] as $section)
                            <p class="ppid-section-header">{{ $section['kategori'] }}</p>

                            <table>
                                <tbody>
                                    <tr>
                                        <th>
                                            <p>Jenis Informasi</p>
                                        </th>
                                        <th>
                                            <p>Link Alternatif</p>
                                        </th>
                                    </tr>
                                    @foreach ($section['items'] as $item)
                                        @php
                                            $rawUrl = $item['url'] ?? '#';
                                            // FIX: validasi URL dari JSON admin sebelum dirender
                                            $url = safe_url($rawUrl, '#');
                                            $isExternal = str_starts_with($url, 'http');
                                            $isDisabled = $url === '#';
                                            $btnClass = $isDisabled
                                                ? 'ppid-btn-link ppid-btn-disabled'
                                                : 'ppid-btn-link';
                                        @endphp
                                        <tr>
                                            <td>
                                                <p>{{ $item['jenis'] }}</p>
                                            </td>
                                            <td>
                                                <p>
                                                    <a href="{{ $url }}"
                                                        @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif
                                                        class="{{ $btnClass }}">
                                                        Klik Disini
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>

                    {{-- Fallback ke content HTML lama jika structured_content belum ada --}}
                @elseif ($page->content)
                    {{-- FIX: sanitasi HTML rich text editor dengan clean() / HTMLPurifier --}}
                    <div class="info-periodic mt-4 prose">
                        {!! clean($page->content) !!}
                    </div>
                @endif

            </div>
        </div>

        <div class="col-lg-4">
            @if ($page->pdf_file)
                <div class="sidebar-widget">
                    <h4>Download</h4>
                    <p>Dokumen terkait halaman ini tersedia untuk diunduh.</p>
                    <a href="{{ Storage::url($page->pdf_file) }}" target="_blank" class="btn btn-primary mt-2">
                        <i class="fas fa-file-pdf me-1"></i> Unduh PDF
                    </a>
                </div>
                {{-- @else
                <div class="sidebar-widget">
                    <h4>Informasi</h4>
                    <p>Dokumen-dokumen berkala dapat diunduh melalui portal informasi publik kami.</p>
                </div> --}}
            @endif
        </div>
    </div>
@endsection
