@extends('layouts.auth')

@section('content')
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Bagian Kiri: Form Register -->
            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h2 class="text-center mb-4"><strong>Register</strong></h2>
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
                            <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
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

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                <button class="btn btn-outline-secondary opacity-50" type="button"
                                    id="toggle-confirm-password">
                                    <i class="fas fa-eye" id="eye-confirm-icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </form>
                    <script>
                        // Toggle for password
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
                        // Toggle for confirm password
                        document.getElementById('toggle-confirm-password').addEventListener('click', function() {
                            const confirmInput = document.getElementById('password-confirm');
                            const eyeConfirmIcon = document.getElementById('eye-confirm-icon');
                            if (confirmInput.type === 'password') {
                                confirmInput.type = 'text';
                                eyeConfirmIcon.classList.remove('fa-eye');
                                eyeConfirmIcon.classList.add('fa-eye-slash');
                            } else {
                                confirmInput.type = 'password';
                                eyeConfirmIcon.classList.remove('fa-eye-slash');
                                eyeConfirmIcon.classList.add('fa-eye');
                            }
                        });
                    </script>
                    <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}"
                            class="text-decoration-none">Masuk di sini</a></p>
                </div>
            </div>
            <!-- Bagian Kanan: Hiasan -->
            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center"
                style="background: linear-gradient(135deg, #103d7c 0%, #146fab 100%);">
                <div class="text-white text-center">
                    <img src="{{ asset('layout/assets/img/icon_page.png') }}" alt="Login Illustration" class="mb-4"
                        style="max-width: 80%;">
                </div>
            </div>
        </div>
    </div>
@endsection
