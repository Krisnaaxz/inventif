@extends('layouts.main')
@section('page_title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-body py-5">
            <div class="row pb-5">
                {{-- filter --}}
                <div class="col-md-6 col-12">
                    <div class="d-flex gap-2 align-items-center border border-secondary-subtle rounded">
                        <div class="flex-grow-1">
                            <x-filter-by-field term="search"
                                placeholder="Cari pengajuan{{ auth()->user()->role === 'organisasi' ? ' peminjaman' : (auth()->user()->role === 'umum' ? ' penyewaan' : '') }}..." />
                        </div>
                        <x-button-reset-filter route="pengajuan.index" />
                        @if (auth()->user()->role === 'admin')
                            <div class="border-start ps-3">
                                <form method="GET" action="{{ route('pengajuan.index') }}">
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    <input type="hidden" name="perPage" value="{{ request('perPage') }}">
                                    <select name="jenis" id="jenis-filter" class="form-select border-0"
                                        onchange="this.form.submit()">
                                        <option value="">Semua Jenis</option>
                                        <option value="peminjaman"
                                            {{ request('jenis') === 'peminjaman' ? 'selected' : '' }}>
                                            Peminjaman</option>
                                        <option value="penyewaan" {{ request('jenis') === 'penyewaan' ? 'selected' : '' }}>
                                            Penyewaan
                                        </option>
                                    </select>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- end filter --}}
            </div>

            <div class="table-responsive">
                <table id="pengajuan-table" class="table table-striped table-bordered text-xs">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 15px">No</th>
                            @if (auth()->user()->role === 'admin')
                                <th style="width: fit-content">Jenis</th>
                            @endif
                            <th>Nama Pengaju</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            @if (auth()->user()->role !== 'organisasi')
                                <th>Durasi (Hari)</th>
                            @endif
                            <th style="width: max-content">Barang
                                {{ auth()->user()->role === 'organisasi' ? 'Dipinjam' : 'Disewa' }}</th>
                            @if (auth()->user()->role !== 'organisasi')
                                <th>Total Biaya</th>
                            @endif
                            <th>Status</th>
                            <th class="text-center" style="width: 150px">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuans as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                @if (auth()->user()->role === 'admin')
                                    <td>{{ ucfirst($item->jenis) }}</td>
                                @endif
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->tanggal_mulai->format('d M Y') }}</td>
                                <td>{{ $item->tanggal_selesai->format('d M Y') }}</td>
                                @if (auth()->user()->role !== 'organisasi')
                                    <td>{{ $item->durasi_sewa ?? '-' }}</td>
                                @endif
                                <td>
                                    @if ($item->inventaris && $item->inventaris->count() > 0)
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($item->inventaris as $inventaris)
                                                <li>{{ $inventaris->nama_inventaris }}
                                                    ({{ $inventaris->pivot->jumlah ?? 1 }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        -
                                    @endif
                                </td>
                                @if (auth()->user()->role !== 'organisasi')
                                    <td>
                                        @if ($item->total_biaya)
                                            <strong class="text-xs">Rp
                                                {{ number_format($item->total_biaya, 0, ',', '.') }}</strong>
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    <span
                                        class="badge badge-{{ in_array($item->status, ['disetujui', 'selesai']) ? 'success' : (in_array($item->status, ['ditolak', 'dibatalkan']) ? 'danger' : 'warning') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                {{-- Action Logic --}}
                                <td>
                                    {{-- Umum --}}
                                    @if (auth()->user()->role === 'umum')
                                        @if ($item->status === 'menunggu')
                                            <div class="d-flex justify-content-center gap-2">
                                                <x-pengajuan.confirm-pengajuan id="{{ $item->id }}"
                                                    route="https://wa.me/+6285183037405" />
                                                <x-pengajuan.cancel-pengajuan id="{{ $item->id }}"
                                                    route="pengajuan.cancel" action="index" />
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
                                        {{-- Organisasi --}}
                                    @elseif (auth()->user()->role === 'organisasi')
                                        @if ($item->status === 'menunggu')
                                            <div class="d-flex justify-content-center gap-2">
                                                <x-pengajuan.confirm-pengajuan id="{{ $item->id }}"
                                                    route="https://wa.me/+6285183037405" />
                                                <x-pengajuan.cancel-pengajuan id="{{ $item->id }}"
                                                    route="pengajuan.cancel" action="index" />
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
                                                    route="pengajuan.approve" action="index" />
                                                <x-pengajuan.reject-pengajuan id="{{ $item->id }}"
                                                    route="pengajuan.reject" action="index" />
                                            </div>
                                        @elseif($item->status === 'disetujui')
                                            <x-pengajuan.selesai-pengajuan id="{{ $item->id }}"
                                                route="pengajuan.selesai" action="index" />
                                        @elseif ($item->status === 'ditolak' || $item->status === 'dibatalkan' || $item->status === 'selesai')
                                            <x-confirm-delete id="{{ $item->id }}" route="pengajuan.destroy" />
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? 10 : (auth()->user()->role === 'umum' ? 9 : 7) }}"
                                    class="text-center">Belum ada
                                    pengajuan{{ auth()->user()->role === 'organisasi' ? ' peminjaman' : (auth()->user()->role === 'umum' ? ' penyewaan' : '') }}.
                                </td>
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
