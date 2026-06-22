@extends('layouts.guest')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-md-8">

            <div class="card shadow-lg border-0">

                <div class="card-header bg-primary text-white text-center py-4">

                    <h2 class="mb-1">
                        Sistem Pengaduan Masyarakat
                    </h2>

                    <p class="mb-0">
                        Registrasi Akun Masyarakat
                    </p>

                </div>

                <div class="card-body p-4">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nama -->

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required>

                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Email -->

                        <div class="mb-3">
                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required>

                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Nomor HP -->

                        <div class="mb-3">
                            <label class="form-label">
                                Nomor HP
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone') }}"
                                required>

                            @error('phone')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Alamat -->

                        <div class="mb-3">
                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea
                                name="address"
                                rows="3"
                                class="form-control"
                                required>{{ old('address') }}</textarea>

                            @error('address')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Password -->

                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                            @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->

                        <div class="mb-4">
                            <label class="form-label">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>
                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg">

                                Daftar Sekarang

                            </button>

                        </div>

                        <div class="text-center mt-4">

                            Sudah punya akun?

                            <a href="{{ route('login') }}">
                                Login di sini
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection