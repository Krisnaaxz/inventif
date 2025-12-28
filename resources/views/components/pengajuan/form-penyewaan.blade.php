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
                                    value="{{ old('tanggal_selesai', isset($tanggal_selesai) ? $tanggal_selesai->format('Y-m-d') : '') }}"
                                    readonly>
                                <small class="text-muted">Otomatis dihitung dari tanggal mulai + durasi sewa</small>
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
                                    value="{{ old('waktu_selesai', $waktu_selesai ?? '') }}" readonly>
                                <small class="text-muted">Otomatis dihitung 24 jam dari waktu mulai</small>
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
                                            <div class="form-check d-flex justify-content-center">
                                                <div class="">
                                                    <input class="form-check-input inventaris-checkbox" type="checkbox"
                                                        id="inventaris_{{ $item->id }}" name="inventaris_ids[]"
                                                        value="{{ $item->id }}"
                                                        data-harga="{{ $item->sewa_inventaris ?? 0 }}"
                                                        {{ in_array($item->id, old('inventaris_ids', [])) ? 'checked' : '' }}>
                                                </div>
                                                <div class="">
                                                    <label class="form-check-label fw-bold"
                                                        for="inventaris_{{ $item->id }}">
                                                        {{ $item->nama_inventaris }}
                                                        <small
                                                            class="text-muted">({{ $item->kategori->nama_kategori ?? 'N/A' }})</small>
                                                    </label>
                                                    <div class="mt-1">
                                                        <small class="text-success fw-bold">Rp
                                                            {{ number_format($item->sewa_inventaris ?? 0, 0, ',', '.') }}/hari</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-auto d-flex align-items-center">
                                                <label for="jumlah_{{ $item->id }}"
                                                    class="me-2 mb-0">Jumlah:</label>
                                                <input type="number"
                                                    class="form-control form-control-sm jumlah-input"
                                                    id="jumlah_{{ $item->id }}"
                                                    name="jumlah[{{ $item->id }}]"
                                                    value="{{ old('jumlah.' . $item->id, 1) }}" min="1"
                                                    max="{{ $item->jumlah_inventaris }}" style="width: 50px;"
                                                    disabled>
                                                <small class="text-muted ms-2">/
                                                    {{ $item->jumlah_inventaris }}</small>
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
                        {{-- 7. total biaya --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Total Biaya Sewa</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="total_biaya" readonly value="0"
                                    style="font-weight: bold; font-size: 1.1em;">
                                <input type="hidden" name="total_biaya" id="total_biaya_hidden" value="0">
                            </div>
                            <small class="text-muted">Biaya dihitung otomatis berdasarkan: Harga × Jumlah ×
                                Durasi</small>
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
            calculateTotalBiaya();
        }

        // Function to calculate waktu selesai (24 hours from waktu mulai)
        function calculateWaktuSelesai() {
            try {
                const waktuMulaiInput = document.getElementById('waktu_mulai');
                const waktuSelesaiInput = document.getElementById('waktu_selesai');

                if (!waktuMulaiInput || !waktuSelesaiInput) {
                    console.warn('Waktu input elements not found');
                    return;
                }

                const waktuMulai = waktuMulaiInput.value;

                if (waktuMulai) {
                    // Since it's exactly 24 hours, the time should be the same
                    waktuSelesaiInput.value = waktuMulai;
                }
            } catch (error) {
                console.error('Error calculating waktu selesai:', error);
            }
        }

        // Function to calculate tanggal selesai (tanggal mulai + durasi sewa)
        function calculateTanggalSelesai() {
            try {
                const tanggalMulaiInput = document.getElementById('tanggal_mulai');
                const durasiSewaInput = document.getElementById('durasi_sewa');
                const tanggalSelesaiInput = document.getElementById('tanggal_selesai');

                if (!tanggalMulaiInput || !durasiSewaInput || !tanggalSelesaiInput) {
                    console.warn('Date input elements not found');
                    return;
                }

                const tanggalMulai = tanggalMulaiInput.value;
                const durasiSewa = parseInt(durasiSewaInput.value) || 1;

                if (tanggalMulai && durasiSewa > 0) {
                    // Parse tanggal mulai
                    const startDate = new Date(tanggalMulai);

                    // Validate start date
                    if (isNaN(startDate.getTime())) {
                        console.warn('Invalid start date:', tanggalMulai);
                        return;
                    }

                    // Add durasi sewa days (durasi sewa - 1 karena hari pertama sudah termasuk)
                    const endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + (durasiSewa - 1));

                    // Format to YYYY-MM-DD
                    const year = endDate.getFullYear();
                    const month = String(endDate.getMonth() + 1).padStart(2, '0');
                    const day = String(endDate.getDate()).padStart(2, '0');

                    tanggalSelesaiInput.value = `${year}-${month}-${day}`;
                }
            } catch (error) {
                console.error('Error calculating tanggal selesai:', error);
            }
        }

        // Function to calculate total biaya
        function calculateTotalBiaya() {
            try {
                let totalBiaya = 0;

                // Get durasi sewa with validation
                const durasiSewaInput = document.getElementById('durasi_sewa');
                const durasiSewa = durasiSewaInput ? parseInt(durasiSewaInput.value) || 1 : 1;

                // Ensure durasi sewa is valid
                if (durasiSewa < 1) {
                    console.warn('Durasi sewa tidak valid:', durasiSewa);
                    return;
                }

                // Loop through all checked inventaris
                document.querySelectorAll('.inventaris-checkbox:checked').forEach(function(checkbox) {
                    try {
                        const inventarisId = checkbox.value;
                        const jumlahInput = document.getElementById('jumlah_' + inventarisId);

                        if (!jumlahInput) {
                            console.warn('Jumlah input tidak ditemukan untuk inventaris ID:',
                                inventarisId);
                            return;
                        }

                        // Get jumlah with validation
                        const jumlah = parseInt(jumlahInput.value) || 1;

                        // Get harga from data attribute with validation
                        const harga = parseInt(checkbox.getAttribute('data-harga')) || 0;

                        // Ensure all values are valid numbers
                        if (isNaN(jumlah) || isNaN(harga) || isNaN(durasiSewa)) {
                            console.warn('Nilai tidak valid untuk perhitungan:', {
                                jumlah,
                                harga,
                                durasiSewa,
                                inventarisId
                            });
                            return;
                        }

                        // Calculate: harga * jumlah * durasi
                        const itemBiaya = harga * jumlah * durasiSewa;
                        totalBiaya += itemBiaya;

                        console.log(
                            `Item ${inventarisId}: ${harga} × ${jumlah} × ${durasiSewa} = ${itemBiaya}`
                            );

                    } catch (itemError) {
                        console.error('Error calculating biaya for item:', checkbox.value, itemError);
                    }
                });

                // Ensure total biaya is a valid number
                if (isNaN(totalBiaya)) {
                    console.error('Total biaya menghasilkan NaN');
                    totalBiaya = 0;
                }

                // Update display elements if they exist
                const totalBiayaDisplay = document.getElementById('total_biaya');
                const totalBiayaHidden = document.getElementById('total_biaya_hidden');

                if (totalBiayaDisplay) {
                    totalBiayaDisplay.value = totalBiaya.toLocaleString('id-ID');
                }

                if (totalBiayaHidden) {
                    totalBiayaHidden.value = totalBiaya;
                }

                console.log('Total biaya calculated:', totalBiaya);

            } catch (error) {
                console.error('Error calculating total biaya:', error);
                // Reset to 0 on error
                const totalBiayaDisplay = document.getElementById('total_biaya');
                const totalBiayaHidden = document.getElementById('total_biaya_hidden');

                if (totalBiayaDisplay) totalBiayaDisplay.value = '0';
                if (totalBiayaHidden) totalBiayaHidden.value = '0';
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

        // Add event listener for waktu mulai
        document.getElementById('waktu_mulai').addEventListener('change', calculateWaktuSelesai);

        // Add event listeners for tanggal mulai and durasi sewa
        document.getElementById('tanggal_mulai').addEventListener('change', calculateTanggalSelesai);
        document.getElementById('durasi_sewa').addEventListener('input', calculateTanggalSelesai);

        // Add event listener for durasi sewa (for total biaya calculation)
        document.getElementById('durasi_sewa').addEventListener('input', calculateTotalBiaya);

        // Validate jumlah input on change
        document.querySelectorAll('.jumlah-input').forEach(function(input) {
            input.addEventListener('input', function() {
                try {
                    const max = parseInt(this.max) || 999;
                    const value = parseInt(this.value) || 1;

                    if (isNaN(value)) {
                        this.value = 1;
                        console.warn('Invalid jumlah value, reset to 1');
                        return;
                    }

                    if (value > max) {
                        this.value = max;
                        alert('Jumlah yang diminta tidak boleh melebihi jumlah tersedia (' +
                            max + ')');
                    }

                    if (value < 1) {
                        this.value = 1;
                    }

                    calculateTotalBiaya();
                } catch (error) {
                    console.error('Error validating jumlah input:', error);
                    this.value = 1;
                }
            });
        });

        // Initial calculations
        calculateWaktuSelesai();
        calculateTanggalSelesai();
        calculateTotalBiaya();
    });
</script>
