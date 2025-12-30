@extends('layouts.main')
@section('page_title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-body py-5">
            <div class="row pb-5">
                {{-- filter --}}
                <div class="col-md-4 col-12 mb-3 mb-md-0">
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
                    <div class="col-md-8 col-12 d-flex justify-content-end">
                        <x-pengajuan.form-peminjaman :inventaris="$inventaris" />
                    </div>
                @endif
                {{-- end form pengajuan --}}
            </div>

            <div class="table-responsive">
                <table id="pengajuan-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 15px">No</th>
                            <th>Nama Pengaju</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Barang Dipinjam</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 150px">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuans->whereIn('status', ['menunggu', 'disetujui']) as $index => $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->tanggal_mulai->format('d M Y') }}</td>
                                <td>{{ $item->tanggal_selesai->format('d M Y') }}</td>
                                <td>
                                    @if ($item->inventaris && $item->inventaris->count() > 0)
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($item->inventaris as $inventaris)
                                                <li class="small">
                                                    {{ $inventaris->nama_inventaris }}
                                                    ({{ $inventaris->pivot->jumlah ?? 1 }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge badge-{{ in_array($item->status, ['disetujui', 'selesai']) ? 'success' : (in_array($item->status, ['ditolak', 'dibatalkan']) ? 'danger' : 'warning') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                {{-- Action Logic --}}
                                <td>
                                    {{-- Organisasi --}}
                                    @if (auth()->user()->role === 'organisasi')
                                        @if ($item->status === 'menunggu')
                                            <div class="d-flex justify-content-center gap-2">
                                                <x-pengajuan.confirm-pengajuan id="{{ $item->id }}"
                                                    route="https://wa.me/+6285183037405" />
                                                <x-pengajuan.cancel-pengajuan id="{{ $item->id }}"
                                                    route="pengajuan.cancel" action="peminjaman" />
                                            </div>
                                        @elseif($item->status === 'disetujui' || $item->status === 'selesai')
                                            <div class="d-flex justify-content-center gap-2">
                                                <span>-</span>
                                            </div>
                                        @elseif($item->status === 'ditolak' || $item->status === 'dibatalkan')
                                            <div class="d-flex justify-content-center gap-2">
                                                <span>-</span>
                                            </div>
                                        @endif
                                        {{-- Admin --}}
                                    @elseif(auth()->user()->role === 'admin')
                                        @if ($item->status === 'menunggu')
                                            <div class="d-flex justify-content-center gap-2">
                                                <x-pengajuan.approve-pengajuan id="{{ $item->id }}"
                                                    route="pengajuan.approve" action="peminjaman" />
                                                <x-pengajuan.reject-pengajuan id="{{ $item->id }}"
                                                    route="pengajuan.reject" action="peminjaman" />
                                            </div>
                                        @elseif($item->status === 'disetujui')
                                            <x-pengajuan.selesai-pengajuan id="{{ $item->id }}"
                                                route="pengajuan.selesai" action="peminjaman" />
                                        @elseif ($item->status === 'ditolak' || $item->status === 'dibatalkan' || $item->status === 'selesai')
                                            <x-confirm-delete id="{{ $item->id }}" route="pengajuan.destroy" />
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pengajuan peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- pagination --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 py-3">
                {{-- jumlah data pagination --}}
                <div class="d-flex justify-content-start align-items-center gap-2">
                    <p class="mb-0">Tampilkan</p>
                    <x-per-page-option />
                    <p class="mb-0">data per halaman</p>
                </div>
                {{-- pagination links --}}
                <div class="d-flex justify-content-end">
                    {{ $pengajuans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
