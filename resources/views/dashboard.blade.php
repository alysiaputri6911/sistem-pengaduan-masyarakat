@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-3">

        <div class="card border-0 shadow">

            <div class="card-body">

                <h6>Total Pengaduan</h6>

                <h1>{{ $total ?? 0 }}</h1>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow">

            <div class="card-body">

                <h6>Open</h6>

                <h1>{{ $open ?? 0  }}</h1>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow">

            <div class="card-body">

                <h6>Diproses</h6>

                <h1>{{ $progress ?? 0 }}</h1>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow">

            <div class="card-body">

                <h6>Selesai</h6>

                <h1>{{ $resolved ?? 0 }}</h1>

            </div>

        </div>

    </div>

</div>

<div class="card mt-4 shadow border-0">

    <div class="card-body">

        <h4>

            Selamat Datang,
            {{ auth()->user()->name }}

        </h4>

        <p>

            Gunakan menu untuk membuat dan memantau
            pengaduan yang telah dikirim.

        </p>

    </div>

</div>

@endsection