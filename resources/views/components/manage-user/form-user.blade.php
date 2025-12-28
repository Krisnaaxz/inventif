<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn {{ $id ? 'btn btn-outline-primary btn-sm me-2' : 'btn-dark' }}"
        data-bs-toggle="modal" data-bs-target="#formUserModal{{ $id ?? '' }}">
        @if ($id)
            <i class="fas fa-edit"></i>
        @else
            <span>Tambah User</span>
        @endif
    </button>

    <!-- Modal -->
    <div class="modal fade" id="formUserModal{{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="formUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formUserModalLabel">Form User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ $action }}" method="POST" autocomplete="off">
                        @csrf
                        @if ($id)
                            @method('PUT')
                        @endif
                        {{-- 1. nama --}}
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $name ?? '') }}" placeholder="Masukkan nama user">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 2. email --}}
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $email ?? '') }}" placeholder="Masukkan email user"
                                autocomplete="off">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 3. role --}}
                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="admin" {{ old('role', $role ?? '') == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="organisasi"
                                    {{ old('role', $role ?? '') == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
                                <option value="umum" {{ old('role', $role ?? '') == 'umum' ? 'selected' : '' }}>Umum
                                </option>
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- 4. password --}}
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan password user" autocomplete="new-password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
</div>
