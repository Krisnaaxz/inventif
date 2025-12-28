<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn {{ isset($id) && $id ? 'btn btn-outline-primary btn-sm me-2' : 'btn-dark' }}"
        data-bs-toggle="modal" data-bs-target="#formPenyewaan{{ isset($id) ? $id : '' }}">
        @if (isset($id) && $id)
            <i class="fas fa-edit">Edit</i>
        @else
            <span>Ajukan Penyewaan</span>
        @endif
    </button>

    <!-- Modal -->
    <div class="modal fade" id="formPenyewaan{{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="formPenyewaanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formPenyewaanLabel">Pengajuan Penyewaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="row mx-1">
                            {{-- 1. tanggal mulai --}}
                            <div class="col-6 form-group mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai', isset($tanggal_mulai) ? $tanggal_mulai->format('Y-m-d') : '') }}">
                                @error('tanggal_mulai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- 2. tanggal selesai --}}
                            <div class="col-6 form-group mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai', isset($tanggal_selesai) ? $tanggal_selesai->format('Y-m-d') : '') }}">
                                @error('tanggal_selesai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mx-1">
                            {{-- 3. waktu mulai --}}
                            <div class="col-6 form-group mb-3">
                                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai"
                                    value="{{ old('waktu_mulai', $waktu_mulai ?? '') }}">
                                @error('waktu_mulai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- 4. waktu selesai --}}
                            <div class="col-6 form-group mb-3">
                                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai"
                                    value="{{ old('waktu_selesai', $waktu_selesai ?? '') }}">
                                @error('waktu_selesai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- 5. durasi sewa --}}
                        <div class="form-group mb-3">
                            <label for="durasi_sewa" class="form-label">Durasi Sewa (hari)</label>
                            <input type="number" class="form-control" id="durasi_sewa" name="durasi_sewa"
                                value="{{ old('durasi_sewa', $durasi_sewa ?? 1) }}" min="1" max="365">
                            @error('durasi_sewa')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 6. keperluan --}}
                        <div class="form-group mb-3 ">
                            <label for="keperluan" class="form-label">Keperluan</label>
                            <textarea class="form-control" id="keperluan" name="keperluan" rows="3"
                                placeholder="Masukkan keperluan penyewaan...">{{ old('keperluan', $keperluan ?? '') }}</textarea>
                            @error('keperluan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 7. barang yang disewa --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Pilih Barang yang Disewa</label>
                            <div class="border p-3" style="max-height: 300px; overflow-y: auto;">
                                @if (isset($inventaris) && $inventaris && $inventaris->count() > 0)
                                    @foreach ($inventaris as $item)
                                        <div class="d-flex align-items-center mb-2 p-2 border rounded">
                                            <div class="form-check me-3">
                                                <input class="form-check-input inventaris-checkbox" type="checkbox"
                                                    id="inventaris_{{ $item->id }}" name="inventaris_ids[]"
                                                    value="{{ $item->id }}"
                                                    {{ in_array($item->id, old('inventaris_ids', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold"
                                                    for="inventaris_{{ $item->id }}">
                                                    {{ $item->nama_inventaris }}
                                                    <small
                                                        class="text-muted">({{ $item->kategori->nama_kategori ?? 'N/A' }})</small>
                                                </label>
                                            </div>
                                            <div class="ms-auto d-flex align-items-center">
                                                <label for="jumlah_{{ $item->id }}"
                                                    class="me-2 mb-0">Jumlah:</label>
                                                <input type="number"
                                                    class="form-control form-control-sm jumlah-input"
                                                    id="jumlah_{{ $item->id }}"
                                                    name="jumlah[{{ $item->id }}]"
                                                    value="{{ old('jumlah.' . $item->id, 1) }}" min="1"
                                                    max="{{ $item->jumlah_inventaris }}" style="width: 80px;"
                                                    disabled>
                                                <small class="text-muted ms-2">/ {{ $item->jumlah_inventaris }}
                                                    tersedia</small>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">Tidak ada inventaris tersedia.</p>
                                @endif
                            </div>
                            @error('inventaris_ids')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @error('jumlah.*')
                                <small class="text-danger">Jumlah yang diminta tidak valid untuk beberapa item.</small>
                            @enderror
                            <small class="text-muted">Pilih minimal 1 inventaris dan tentukan jumlah yang
                                dibutuhkan.</small>
                        </div>
                        {{-- 8. surat pengajuan --}}
                        <div class="form-group mb-3">
                            <label for="surat_pengajuan" class="form-label">Surat Pengajuan (PDF, max 2MB)</label>
                            <input type="file" class="form-control" id="surat_pengajuan" name="surat_pengajuan"
                                value="{{ old('surat_pengajuan', $surat_pengajuan ?? '') }}">
                            @error('surat_pengajuan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- hidden --}}
                        {{-- 9. jenis --}}
                        <input type="hidden" name="jenis" value="penyewaan">
                        {{-- 10. status --}}
                        <input type="hidden" name="status" value="menunggu">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle jumlah input based on checkbox
        function toggleJumlahInput(checkbox) {
            const inventarisId = checkbox.value;
            const jumlahInput = document.getElementById('jumlah_' + inventarisId);

            if (checkbox.checked) {
                jumlahInput.disabled = false;
                jumlahInput.focus();
            } else {
                jumlahInput.disabled = true;
                jumlahInput.value = 1;
            }
        }

        // Add event listeners to all inventaris checkboxes
        document.querySelectorAll('.inventaris-checkbox').forEach(function(checkbox) {
            // Set initial state
            toggleJumlahInput(checkbox);

            // Add change event listener
            checkbox.addEventListener('change', function() {
                toggleJumlahInput(this);
            });
        });

        // Validate jumlah input on change
        document.querySelectorAll('.jumlah-input').forEach(function(input) {
            input.addEventListener('input', function() {
                const max = parseInt(this.max);
                const value = parseInt(this.value);

                if (value > max) {
                    this.value = max;
                    alert('Jumlah yang diminta tidak boleh melebihi jumlah tersedia (' + max +
                        ')');
                }

                if (value < 1) {
                    this.value = 1;
                }
            });
        });
    });
</script>
