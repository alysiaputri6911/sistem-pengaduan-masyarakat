@extends('layouts.guest')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-lg-10">

            <div class="card shadow-lg border-0 overflow-hidden">

                <div class="row g-0">

                    <!-- Bagian Kiri -->
                    <div class="col-md-6 bg-primary text-white d-flex flex-column justify-content-center p-5">

                        <h1 class="fw-bold mb-3">
                            Sistem Pengaduan Masyarakat
                        </h1>

                        <p class="fs-5">
                            Laporkan setiap keluhan masyarakat secara cepat,
                            transparan dan mudah.
                        </p>

                        <hr>

                        <ul class="list-unstyled mt-4">
                            <li class="mb-3">✔ Pengaduan Online</li>
                            <li class="mb-3">✔ Monitoring Status</li>
                            <li class="mb-3">✔ Aman & Transparan</li>
                        </ul>

                    </div>

                    <!-- Bagian Login -->
                    <div class="col-md-6 p-5">

                        <h2 class="fw-bold text-center mb-2">
                            Login
                        </h2>

                        <p class="text-center text-muted mb-4">
                            Silakan login menggunakan akun Anda.
                        </p>

                        <x-auth-session-status
                            class="mb-3"
                            :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus>

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required>

                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-check mb-4">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="remember">

                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    Lupa Password?
                                </a>

                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">
                                    Register
                                </a>
                            </div>


                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection