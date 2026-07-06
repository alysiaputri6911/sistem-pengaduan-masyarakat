@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg border-0" style="width: 420px; border-radius: 15px;">
        
        <div class="card-body p-4">
            <h4 class="text-center fw-bold mb-2">Lupa Password</h4>
            <p class="text-muted text-center mb-4">
                Masukkan email Anda untuk menerima link reset password
            </p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <button class="btn btn-primary w-100">
                    Kirim Link Reset
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection