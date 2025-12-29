@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Profil</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profile_photo">Foto Profil</label>
                                    <input type="file" class="form-control @error('profile_photo') is-invalid @enderror"
                                        id="profile_photo" name="profile_photo" accept="image/*">
                                    @error('profile_photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Pilih file gambar (JPG, PNG, dll.) maksimal
                                        2MB</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" class="form-control" id="role"
                                        value="{{ ucfirst($user->role) }}" readonly>
                                    <small class="form-text text-muted">Role tidak dapat diubah</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="created_at">Bergabung Sejak</label>
                                    <input type="text" class="form-control" id="created_at"
                                        value="{{ $user->created_at->format('d M Y') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5 class="mb-3">Ubah Password</h5>
                        <p class="text-muted">Kosongkan field password jika tidak ingin mengubah password</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="current_password">Password Saat Ini</label>
                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password">
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex gap-2 mt-4 justify-content-end">
                            <a href="{{ route('home') }}" class="btn btn-danger">
                                <i class="fas fa-arrow-left"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Akun</h4>
                </div>
                <div class="card-body text-center">
                    <div class="">
                        <img src="{{ $user->profile_photo_url }}" alt="Avatar" class="avatar-img rounded-circle"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-title">Statistik</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h3 class="text-primary">{{ $user->pengajuans->count() }}</h3>
                            <p class="text-muted">Total Pengajuan</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-success">{{ $user->pengajuans->where('status', 'disetujui')->count() }}</h3>
                            <p class="text-muted">Pengajuan Disetujui</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password confirmation validation
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            function validatePassword() {
                if (password.value !== passwordConfirmation.value) {
                    passwordConfirmation.setCustomValidity('Password tidak cocok');
                } else {
                    passwordConfirmation.setCustomValidity('');
                }
            }

            password.addEventListener('input', validatePassword);
            passwordConfirmation.addEventListener('input', validatePassword);
        });
    </script>
@endpush
