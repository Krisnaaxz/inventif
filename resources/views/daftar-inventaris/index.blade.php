@extends('layouts.main')
@section('page_title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-body py-5">
            <div class="row pb-5">
                {{-- filter --}}
                <div class="col-4">
                    <div class="d-flex gap-2 align-items-center border border-secondary-subtle rounded">
                        <div class="flex-grow-1">
                            <x-filter-by-field term="search" placeholder="Cari inventaris..." />
                        </div>
                        <x-button-reset-filter route="inventaris.daftar-inventaris.index" />
                    </div>
                </div>
                {{-- end filter --}}
                {{-- form inventaris --}}
                <div class="col-8 d-flex justify-content-end">
                    <x-inventaris.form-inventaris />
                </div>
                {{-- end form inventaris --}}
            </div>

            <table id="daftar-inventaris-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 15px">No</th>
                        <th>Nama Inventaris</th>
                        <th>Kategori</th>
                        <th class="text-center" style="width: 150px">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inventaris as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->nama_inventaris }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <x-inventaris.form-inventaris id="{{ $item->id }}" />
                                    <x-view-meta id="{{ $item->id }}" route="inventaris.daftar-inventaris.show" />
                                    <x-confirm-delete id="{{ $item->id }}"
                                        route="inventaris.daftar-inventaris.destroy" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Data Inventaris Kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- pagination --}}
            <div class="row-10 py-3 d-flex justify-content-between align-items-center">
                {{-- jumlah data pagination --}}
                <div class="col-4 d-flex justify-content-start align-items-center gap-2">
                    <p class="mb-0">Tampilkan</p>
                    <x-per-page-option />
                    <p class="mb-0">data per halaman</p>
                </div>
                {{-- pagination links --}}
                <div class="col-8 d-flex justify-content-end">
                    {{ $inventaris->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
