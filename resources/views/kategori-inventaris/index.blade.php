@extends('layouts.main')
@section('content')
@section('page_title', $pageTitle)
<div class="card">
    <div class="card-body py-5">
        <div class="">
            <x-kategori-inventaris.form-kategori-inventaris />
        </div>
        <table id="kategori-inventaris-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 15px">No</th>
                    <th>Nama Kategori\</th>
                    <th class="text-center" style="width: 100px">Opsi</th>
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

                                <x-confirm-delete route="inventaris.kategori-inventaris.destroy"
                                    id="{{ $item->id }}" />
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
    </div>
@endsection
