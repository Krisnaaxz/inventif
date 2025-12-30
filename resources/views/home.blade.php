@extends('layouts.main')
@section('page_title', 'Beranda')

@section('content')
    <div class="container-fluid">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-lg"
                    style="background: linear-gradient(135deg, #022E9B 0%, #479AFF 100%); border: none; color: white;">
                    <div class="card-body text-center py-5">
                        <h1 class="display-4 text-white strong">Selamat Datang di Sistem Inventaris</h1>
                        <p class="lead text-white-50">{{ __('You are logged in as ') . auth()->user()->name }}</p>
                        @if (session('status'))
                            <div class="alert alert-light mt-3" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Section (Admin Only) -->
        @if (auth()->user()->role === 'admin')
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="mb-3">Statistik Data</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x mb-3"
                                style="background: linear-gradient(135deg, #D6780B 0%, #ECB246 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            <h5 class="card-title text-muted">Total Pengguna</h5>
                            <h2 class="fw-bold"
                                style="background: linear-gradient(135deg, #D6780B 0%, #ECB246 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                {{ $totalUsers }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-boxes fa-3x mb-3"
                                style="background: linear-gradient(135deg, #199D5F 0%, #5BF57D 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            <h5 class="card-title text-muted">Total Inventaris</h5>
                            <h2 class="fw-bold"
                                style="background: linear-gradient(135deg, #199D5F 0%, #5BF57D 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                {{ $totalInventaris }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-handshake fa-3x mb-3"
                                style="background: linear-gradient(135deg, #1AAAE8 0%, #46CDEC 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            <h5 class="card-title text-muted">Total Peminjaman</h5>
                            <h2 class="fw-bold"
                                style="background: linear-gradient(135deg, #1AAAE8 0%, #46CDEC 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                {{ $totalPeminjaman }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-money-bill-wave fa-3x mb-3"
                                style="background: linear-gradient(135deg, #14379A 0%, #4285F4 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            <h5 class="card-title text-muted">Total Penyewaan</h5>
                            <h2 class="fw-bold"
                                style="background: linear-gradient(135deg, #14379A 0%, #4285F4 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                {{ $totalPenyewaan }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="mb-3">Navigasi Cepat</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-boxes fa-3x text-success mb-3"
                                style="background: linear-gradient(135deg, #199D5F 0%, #5BF57D 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            <h5 class="card-title">Daftar Inventaris</h5>
                            <p class="card-text">Kelola inventaris yang tersedia</p>
                            <a href="{{ route('inventaris.daftar-inventaris.index') }}" class="btn"
                                style="background: linear-gradient(135deg, #199D5F 0%, #5BF57D 100%); border: none; color: white;">Lihat
                                Inventaris</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-file-alt fa-3x text-primary mb-3"
                                style="background: linear-gradient(135deg, #14379A 0%, #4285F4 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            <h5 class="card-title">Data Pengajuan</h5>
                            <p class="card-text">Lihat semua pengajuan inventaris</p>
                            <a href="{{ route('pengajuan.index') }}" class="btn"
                                style="background: linear-gradient(135deg, #14379A 0%, #4285F4 100%); border: none; color: white;">Lihat
                                Pengajuan</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- SOP and Templates -->
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="mb-3">Dokumen & SOP</h3>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-pdf fa-3x mb-3"
                            style="background: linear-gradient(135deg, #771414 0%, #FF3B3B 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                        <h5 class="card-title">SOP Peminjaman</h5>
                        <p class="card-text">Panduan lengkap untuk peminjaman inventaris</p>
                        <a href="https://drive.google.com/file/d/1ThsbnFLFL48sMmoQlVS8l1RUWYqvXKCW/view?usp=sharing"
                            class="btn"
                            style="background: linear-gradient(135deg, #771414 0%, #FF3B3B 100%); border: none; color: white;">Download
                            SOP</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-pdf fa-3x mb-3"
                            style="background: linear-gradient(135deg, #771414 0%, #FF3B3B 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                        <h5 class="card-title">SOP Penyewaan</h5>
                        <p class="card-text">Panduan lengkap untuk penyewaan inventaris</p>
                        <a href="https://drive.google.com/file/d/1_jhjm4XN_Zf1vUzhQvkxqHOPURWaGjzr/view?usp=sharing"
                            class="btn"
                            style="background: linear-gradient(135deg, #771414 0%, #FF3B3B 100%); border: none; color: white;">Download
                            SOP</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-word fa-3x mb-3"
                            style="background: linear-gradient(135deg, #14379A 0%, #4285F4 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                        <h5 class="card-title">Template Surat Pengajuan</h5>
                        <p class="card-text">Template untuk membuat surat pengajuan</p>
                        <a href="https://docs.google.com/document/d/1B1JjP9bcjbtwsTsguU1wj2hBTVheaMw6/edit?usp=sharing&ouid=116861587190975764152&rtpof=true&sd=true"
                            class="btn"
                            style="background: linear-gradient(135deg, #14379A 0%, #4285F4 100%); border: none; color: white;">Download
                            Template</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="row">
            <div class="col-12">
                <h3 class="mb-3">Ikuti Kami</h3>
                <div class="d-flex flex-wrap justify-content-center gap-2 gap-md-3">
                    <a href="https://instagram.com/himaif_udayana" target="_blank" class="btn border-outline"
                        style="background: linear-gradient(135deg, #E26B44 0%, #C8376E 100%); border: none; color: white; min-width: 120px;"></i>
                        <i class="fab fa-instagram"
                            style="background: linear-gradient(135deg, #570404 0%, #FF3B3B 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i></i>
                        Instagram
                    </a>
                    <a href="https://wa.me/+6285183037405" target="_blank" class="btn btn-outline"
                        style="background: linear-gradient(135deg, #0E8E3D 0%, #17AD71 100%); border: none; color: white; min-width: 120px;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://tiktok.com/@himaif_udayana" target="_blank" class="btn btn-outline-dark"
                        style="background: linear-gradient(135deg, #000000 0%, #434343 100%); border: none; color: white; min-width: 120px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                            class="bi bi-tiktok" viewBox="0 0 16 16">
                            <path
                                d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                        </svg> TikTok
                    </a>
                    <a href="https://www.linkedin.com/company/himaif-udayana/" target="_blank"
                        class="btn btn-outline-info"
                        style="background: linear-gradient(135deg, #0A66C2 0%, #004182 100%); border: none; color: white; min-width: 120px;">
                        <i class="fab fa-linkedin"></i> LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
