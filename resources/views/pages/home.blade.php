{{-- resources/views/pages/home.blade.php --}}
@extends('layouts.app', ['title' => 'PPID Dinas Arsip dan Perpustakaan Kota Semarang'])

@section('content')
    <x-hero />

    {{-- <x-stats-counter :stats="$stats" /> --}}

    <x-layanan-section :layanans="$layanans" />

    <x-berita-terkini :beritaFeatured="$beritaFeatured" :beritaList="$beritaList" />

    <x-infografis-statistik :statistikKearsipan="$statistikKearsipan" :statistikKunjungan="$statistikKunjungan" />

    <x-dokumen-permohonan :daftarInformasi="$daftarInformasi" />
@endsection
