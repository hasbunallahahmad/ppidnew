@extends('layouts.menu-page')

@section('page-content')
    <div class="row">
        <div class="col-lg-10">
            <div class="content-box">
                <h2>{{ $page->title }}</h2>

                @if ($page->description)
                    <p class="lead">{{ $page->description }}</p>
                @endif

                @if (!empty($page->structured_content['rows']))
                    <div class="info-setiap-saat mt-4">
                        <div class="table-responsive">
                            <table class="iss-table">
                                <thead>
                                    <tr>
                                        <th style="width:5%; text-align:center;">No</th>
                                        <th style="width:25%;">Jenis Informasi</th>
                                        <th style="width:30%;">Rincian Informasi</th>
                                        <th style="width:40%;">Keterangan / Contoh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($page->structured_content['rows'] as $row)
                                        @php
                                            $subcount = count($row['sub'] ?? []);
                                            $hasMultipleSub = $subcount > 1;
                                        @endphp

                                        @if ($subcount === 0)
                                            {{-- Baris tanpa sub-kategori --}}
                                            <tr>
                                                <td class="text-center align-middle">{{ $row['no'] }}</td>
                                                <td class="align-middle">{{ $row['jenis'] }}</td>
                                                <td class="align-middle">&nbsp;</td>
                                                <td class="align-middle">
                                                    @if (!empty($row['items']))
                                                        <ul class="iss-list">
                                                            @foreach ($row['items'] as $item)
                                                                <li>
                                                                    @if (!empty($item['url']) && $item['url'] !== '#')
                                                                        <a href="{{ $item['url'] }}"
                                                                            @if (str_starts_with($item['url'], 'http')) target="_blank" rel="noopener noreferrer" @endif>
                                                                            {{ $item['label'] }}
                                                                        </a>
                                                                    @else
                                                                        {{ $item['label'] }}
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @elseif (!empty($row['keterangan']))
                                                        {!! $row['keterangan'] !!}
                                                    @endif
                                                </td>
                                            </tr>
                                        @else
                                            {{-- Baris dengan sub-kategori --}}
                                            @foreach ($row['sub'] as $i => $sub)
                                                <tr>
                                                    @if ($i === 0)
                                                        <td class="text-center align-middle" rowspan="{{ $subcount }}">
                                                            {{ $row['no'] }}</td>
                                                        <td class="align-middle" rowspan="{{ $subcount }}">
                                                            {{ $row['jenis'] }}</td>
                                                    @endif
                                                    <td class="iss-subcategory text-center align-middle">
                                                        {{ $sub['rincian'] }}</td>
                                                    <td class="align-middle">
                                                        @if (!empty($sub['items']))
                                                            <ul class="iss-list">
                                                                @foreach ($sub['items'] as $item)
                                                                    <li>
                                                                        @if (!empty($item['url']) && $item['url'] !== '#')
                                                                            <a href="{{ $item['url'] }}"
                                                                                @if (str_starts_with($item['url'], 'http')) target="_blank" rel="noopener noreferrer" @endif>
                                                                                {{ $item['label'] }}
                                                                            </a>
                                                                        @else
                                                                            {{ $item['label'] }}
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @elseif (!empty($sub['keterangan']))
                                                            {!! $sub['keterangan'] !!}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif ($page->content)
                    <div class="mt-4 prose">
                        {!! $page->content !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-2">
            @if ($page->pdf_file)
                <div class="sidebar-widget">
                    <h4>Download</h4>
                    <p>Dokumen terkait tersedia untuk diunduh.</p>
                    <a href="{{ Storage::url($page->pdf_file) }}" target="_blank" class="btn btn-primary mt-2">
                        <i class="fas fa-file-pdf me-1"></i> Unduh PDF
                    </a>
                </div>
                {{-- @else
                <div class="sidebar-widget">
                    <h4>Informasi</h4>
                    <p>Dokumen-dokumen dapat diunduh melalui portal informasi publik kami.</p>
                </div> --}}
            @endif
        </div>
    </div>
@endsection
