<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address --><x-guest-layout>

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

                            <li class="mb-3">
                                ✔ Pengaduan Online
                            </li>

                            <li class="mb-3">
                                ✔ Monitoring Status
                            </li>

                            <li class="mb-3">
                                ✔ Aman & Transparan
                            </li>

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

                        <form method="POST"
                              action="{{ route('login') }}">

                            @csrf

                            <!-- Email -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

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

                            <!-- Password -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Password

                                </label>

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

                            <!-- Remember -->

                            <div class="form-check mb-4">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="remember">

                                <label
                                    class="form-check-label"
                                    for="remember">

                                    Ingat Saya

                                </label>

                            </div>

                            <button
                                class="btn btn-primary w-100">

                                Login

                            </button>

                            @if (Route::has('password.request'))

                            <div class="text-center mt-4">

                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-decoration-none">

                                    Lupa Password?

                                </a>

                            </div>

                            @endif

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-guest-layout>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
