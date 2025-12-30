@extends('layouts.main')
@section('page_title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-body py-5">
            <div class="row pb-5 g-3">
                {{-- filter --}}
                <div class="col-md-4 col-12">
                    <div class="d-flex gap-2 align-items-center border border-secondary-subtle rounded">
                        <div class="flex-grow-1">
                            <x-filter-by-field term="search" placeholder="Cari inventaris..." />
                        </div>
                        <x-button-reset-filter route="inventaris.daftar-inventaris.index" />
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="border border-secondary-subtle rounded" style="max-width: 200px;">
                        <x-filter-by-options :options="$kategori" term="kategori" defaultValue="Semua Kategori"
                            field="nama_kategori" />
                    </div>
                </div>
                {{-- end filter --}}
                {{-- form inventaris --}}
                @if (auth()->user()->role === 'admin')
                    <div class="col-md-5 col-12 d-flex justify-content-md-end justify-content-start">
                        <x-inventaris.form-inventaris />
                    </div>
                @endif
                {{-- end form inventaris --}}
            </div>

            <div class="table-responsive">
                <table id="daftar-inventaris-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 15px">No</th>
                            <th>Nama Inventaris</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th class="text-center" style="width: 150px">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inventaris as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $item->nama_inventaris }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>{{ $item->jumlah_inventaris }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <x-view-meta id="{{ $item->id }}" route="inventaris.daftar-inventaris.show" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Inventaris Kosong.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- pagination --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-3 gap-2">
                {{-- jumlah data pagination --}}
                <div class="d-flex justify-content-start align-items-center gap-2">
                    <p class="mb-0">Tampilkan</p>
                    <x-per-page-option />
                    <p class="mb-0">data per halaman</p>
                </div>
                {{-- pagination links --}}
                <div class="d-flex justify-content-center justify-content-md-end">
                    {{ $inventaris->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
