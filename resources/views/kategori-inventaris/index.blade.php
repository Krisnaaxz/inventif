@extends('layouts.main')
@section('content')
@section('page_title', $pageTitle)
<div class="card">
    <div class="card-body py-5">
        <div class="row pb-5">
            {{-- filter --}}
            <div class="col-4">
                <div class="d-flex gap-2 align-items-center border border-secondary-subtle rounded">
                    <div class="flex-grow-1">
                        <x-filter-by-field term="search" placeholder="Cari kategori..." />
                    </div>
                    <x-button-reset-filter route="inventaris.kategori-inventaris.index" />
                </div>
            </div>
            {{-- end filter --}}

            {{-- form kategori --}}
            <div class="col-8 d-flex justify-content-end">
                <x-kategori-inventaris.form-kategori-inventaris />
            </div>
            {{-- end form kategori --}}
        </div>

        <table id="kategori-inventaris-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 15px">No</th>
                    <th>Nama Kategori</th>
                    <th class="text-center" style="width: 200px">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <x-kategori-inventaris.form-kategori-inventaris id="{{ $item->id }}" />
                                <x-confirm-delete id="{{ $item->id }}"
                                    route="inventaris.kategori-inventaris.destroy" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Data Kategori Kosong.</td>
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
            {{-- halaman pagination --}}
            {{ $kategori->links() }}
        </div>
        {{-- end pagination --}}
    </div>
</div>
@endsection
