<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-round {{ $id ? 'btn-primary btn-icon' : 'btn-dark' }}" data-bs-toggle="modal"
        data-bs-target="#formInventaris{{ $id ?? '' }}">
        @if ($id)
            <i class="fas fa-edit"></i>
        @else
            <span>Tambah Inventaris</span>
        @endif

    </button>

    <!-- Modal -->
    <div class="modal fade" id="formInventaris{{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="formInventarisLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($id)
                        @method('PUT')
                    @endif
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formInventarisLabel">Form Inventaris</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- 1. nama inventaris --}}
                        <div class="form-group mb-3">
                            <label for="nama_inventaris" class="form-label">Nama Inventaris</label>
                            <input type="text" class="form-control" id="nama_inventaris" name="nama_inventaris"
                                value="{{ old('nama_inventaris', $nama_inventaris ?? '') }}"
                                placeholder="Masukkan nama inventaris">
                            @error('nama_inventaris')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 2. kategori inventaris --}}
                        <div class="form-group mb-3">
                            <label for="kategori_inventaris_id" class="form-label">Kategori Inventaris</label>
                            <select class="form-control" id="kategori_inventaris_id" name="kategori_inventaris_id">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategori_inventaris as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_inventaris_id', $kategori_inventaris_id ?? '') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_inventaris_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 3. jumlah inventaris --}}
                        <div class="form-group mb-3">
                            <label for="jumlah_inventaris" class="form-label">Jumlah Inventaris</label>
                            <input type="number" class="form-control" id="jumlah_inventaris" name="jumlah_inventaris"
                                value="{{ old('jumlah_inventaris', $jumlah_inventaris ?? '') }}"
                                placeholder="Masukkan jumlah inventaris">
                            @error('jumlah_inventaris')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 4. harga inventaris --}}
                        <div class="form-group mb-3">
                            <label for="harga_inventaris" class="form-label">Harga Satuan</label>
                            <input type="number" class="form-control" id="harga_inventaris" name="harga_inventaris"
                                value="{{ old('harga_inventaris', $harga_inventaris ?? '') }}"
                                placeholder="Masukkan harga inventaris">
                            @error('harga_inventaris')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 5. sewa inventaris --}}
                        <div class="form-group mb-3">
                            <label for="sewa_inventaris" class="form-label">Harga Sewa</label>
                            <input type="number" class="form-control" id="sewa_inventaris" name="sewa_inventaris"
                                value="{{ old('sewa_inventaris', $sewa_inventaris ?? '') }}"
                                placeholder="Masukkan harga sewa">
                            @error('sewa_inventaris')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 6. gambar inventaris --}}
                        <div class="form-group mb-3">
                            <label for="gambar_inventaris" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar_inventaris" name="gambar_inventaris"
                                placeholder="Masukkan gambar inventaris">
                            @error('gambar_inventaris')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 7. deskripsi inventaris --}}
                        <div class="form-group mb-3">
                            <label for="deskripsi_inventaris" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_inventaris" name="deskripsi_inventaris" rows="3"
                                placeholder="Masukkan deskripsi inventaris">{{ old('deskripsi_inventaris', $deskripsi_inventaris ?? '') }}</textarea>
                            @error('deskripsi_inventaris')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
