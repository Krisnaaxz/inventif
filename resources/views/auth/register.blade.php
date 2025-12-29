@extends('layouts.auth')

@section('content')
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Bagian Kiri: Form Register -->
            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h2 class="text-center mb-4">Register</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </form>
                    <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}"
                            class="text-decoration-none">Masuk di sini</a></p>
                </div>
            </div>
            <!-- Bagian Kanan: Hiasan -->
            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center"
                style="background: linear-gradient(135deg, #146fab 0%, #103d7c 100%);">
                <div class="text-white text-center">
                    <h1>Bergabunglah</h1>
                    <p>Daftar untuk mengakses sistem inventaris</p>
                </div>
            </div>
        </div>
    </div>
@endsection
