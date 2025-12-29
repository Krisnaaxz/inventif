@extends('layouts.auth')

@section('content')
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Bagian Kiri: Hiasan -->
            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center"
                style="background: linear-gradient(135deg, #103d7c 0%, #146fab 100%);">
                <div class="text-white text-center">
                    <img src="{{ asset('layout/assets/img/icon_page.png') }}" alt="Login Illustration" class="mb-4"
                        style="max-width: 80%;">
                </div>
            </div>
            <!-- Bagian Kanan: Form Login -->
            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h2 class="text-center mb-4"><strong>Login</strong></h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                <button class="btn btn-outline-secondary opacity-50" type="button" id="toggle-password">
                                    <i class="fas fa-eye" id="eye-icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </form>
                    <script>
                        document.getElementById('toggle-password').addEventListener('click', function() {
                            const passwordInput = document.getElementById('password');
                            const eyeIcon = document.getElementById('eye-icon');
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                eyeIcon.classList.remove('fa-eye');
                                eyeIcon.classList.add('fa-eye-slash');
                            } else {
                                passwordInput.type = 'password';
                                eyeIcon.classList.remove('fa-eye-slash');
                                eyeIcon.classList.add('fa-eye');
                            }
                        });
                    </script>
                    <p class="text-center mt-3">Belum punya akun? <a href="{{ route('register') }}"
                            class="text-decoration-none">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
