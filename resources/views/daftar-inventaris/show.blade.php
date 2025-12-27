@extends('layouts.main')
@section('page_title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('inventaris.daftar-inventaris.index') }}" class="btn btn-light border btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h5 class="mb-0 text-muted">Detail Inventaris</h5>
                <div style="width: 80px;"></div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <!-- Gambar Produk -->
                <div class="col-md-4 mb-4">
                    <div class="border rounded p-3 bg-light">
                        <img src="{{ asset('storage/inventaris/' . $inventaris->gambar_inventaris) }}"
                            alt="{{ $inventaris->nama_inventaris }}" class="img-fluid rounded"
                            style="max-height: 400px; width: 100%; object-fit: cover;">
                    </div>
                </div>

                <!-- Detail Informasi -->
                <div class="col-md-8">
                    <h4 class="mb-4 fw-normal">{{ $inventaris->nama_inventaris }}</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted" style="width: 180px;">Kategori</td>
                                    <td style="width: 20px;">:</td>
                                    <td>
                                        <span
                                            class="badge bg-light text-dark border">{{ $inventaris->kategori->nama_kategori }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jumlah Tersedia</td>
                                    <td>:</td>
                                    <td>{{ $inventaris->jumlah_inventaris }} Unit</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Harga Satuan</td>
                                    <td>:</td>
                                    <td class="fw-semibold">
                                        Rp {{ number_format($inventaris->harga_inventaris, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Harga Sewa</td>
                                    <td>:</td>
                                    <td class="fw-semibold">
                                        Rp {{ number_format($inventaris->sewa_inventaris, 0, ',', '.') }} <small
                                            class="text-muted">/hari</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <h6 class="text-muted mb-2">Deskripsi</h6>
                        <p class="mb-0" style="line-height: 1.6;">{{ $inventaris->deskripsi_inventaris }}</p>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex gap-2">
                            <x-inventaris.form-inventaris id="{{ $inventaris->id }}" />
                            <x-confirm-delete id="{{ $inventaris->id }}" route="inventaris.daftar-inventaris.destroy" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
