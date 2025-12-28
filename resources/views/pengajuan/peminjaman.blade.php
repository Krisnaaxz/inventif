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
                            <x-filter-by-field term="search" placeholder="Cari pengajuan peminjaman..." />
                        </div>
                        <x-button-reset-filter route="pengajuan.peminjaman" />
                    </div>
                </div>
                {{-- end filter --}}
                {{-- form pengajuan --}}
                @if (auth()->user()->role === 'organisasi')
                    <div class="col-8 d-flex justify-content-end">
                        <x-pengajuan.form-peminjaman :inventaris="$inventaris" />
                    </div>
                @endif
                {{-- end form pengajuan --}}
            </div>

            <table id="pengajuan-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 15px">No</th>
                        <th>Nama Pengaju</th>
                        <th>Barang Dipinjam</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 150px">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuans as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                @if ($item->inventaris && $item->inventaris->count() > 0)
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($item->inventaris as $inventaris)
                                            <li class="small">
                                                {{ $inventaris->nama_inventaris }}
                                                <span class="badge bg-secondary">{{ $inventaris->pivot->jumlah }}
                                                    unit</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $item->tanggal_mulai->format('d M Y') }}</td>
                            <td>{{ $item->tanggal_selesai->format('d M Y') }}</td>
                            <td>
                                <span
                                    class="badge badge-{{ $item->status === 'disetujui' ? 'success' : ($item->status === 'ditolak' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <x-view-meta id="{{ $item->id }}" route="pengajuan.show" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pengajuan peminjaman.</td>
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
                    {{ $pengajuans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
