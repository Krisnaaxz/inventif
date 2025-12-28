@extends('layouts.main')
@section('page_title', $pageTitle)
@section('content')
    @if (auth()->user()->role === 'organisasi')
        <div>
            @yield('peminjaman')
        </div>
    @else
        <div>
            @yield('penyewaan')
        </div>
    @endif
@endsection
