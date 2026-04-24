@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="container">
            <h1>{{ $pageTitle }}</h1>
            <p class="page-subtitle">{{ $pageDescription ?? '' }}</p>
        </div>
    </div>

    <main class="page-content">
        <div class="container">
            @yield('page-content')
        </div>
    </main>
@endsection
