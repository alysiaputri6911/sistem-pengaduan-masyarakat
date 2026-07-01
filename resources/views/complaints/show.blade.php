@extends('layouts.app')

@section('content')

<div class="container">

    {{-- DETAIL PENGADUAN --}}
    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    Detail Pengaduan
                </h4>

                <a href="{{ route('complaints.index') }}"
                   class="btn btn-light btn-sm">

                    ← Kembali

                </a>

            </div>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">Kode Pengaduan</th>
                    <td>{{ $complaint->complaint_code }}</td>
                </tr>

                <tr>
                    <th>Judul</th>
                    <td>{{ $complaint->title }}</td>
                </tr>

                <tr>
                    <th>Kategori</th>
                    <td>{{ $complaint->category }}</td>
                </tr>

                <tr>
                    <th>Lokasi</th>
                    <td>{{ $complaint->location }}</td>
                </tr>

                <tr>
                    <th>Nama Pelapor</th>
                    <td>{{ $complaint->complainant_name }}</td>
                </tr>

                <tr>
                    <th>No HP</th>
                    <td>{{ $complaint->phone }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $complaint->email }}</td>
                </tr>

                <tr>
                    <th>Prioritas</th>

                    <td>

                        <span class="badge bg-{{ $complaint->priority_badge }}">

                            {{ $complaint->priority_label }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>Status</th>

                    <td>

                        <span class="badge bg-{{ $complaint->status_badge }}">

                            {{ $complaint->status_label }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>Tanggal Pengaduan</th>

                    <td>

                        {{ $complaint->created_at->format('d M Y H:i') }}

                    </td>

                </tr>

            </table>

            <hr>

            <h5>Deskripsi Pengaduan</h5>

            <div class="alert alert-light border">

                {{ $complaint->description }}

            </div>

            @if($complaint->attachment)

            <hr>

            <h5>Bukti Foto Pengaduan</h5>

            <div class="text-center">

                <img
                    src="{{ asset('storage/'.$complaint->attachment) }}"
                    class="img-fluid rounded shadow"
                    style="max-width:500px;">

            </div>

            @endif

        </div>

    </div>


    {{-- TRACKING STATUS --}}

    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-warning">

            <h5 class="mb-0">

                Tracking Status Pengaduan

            </h5>

        </div>

        <div class="card-body">

            <div class="progress mb-3" style="height:25px;">

                @php

                    $progress = match($complaint->status){

                        'pending'=>10,
                        'open'=>25,
                        'in_review'=>45,
                        'progress'=>70,
                        'resolved'=>90,
                        'closed'=>100,
                        default=>0

                    };

                @endphp

                <div
                    class="progress-bar bg-success"
                    style="width:{{ $progress }}%">

                    {{ $progress }}%

                </div>

            </div>

            <div class="row text-center">

                <div class="col">Pending</div>

                <div class="col">Open</div>

                <div class="col">Review</div>

                <div class="col">Progress</div>

                <div class="col">Resolved</div>

                <div class="col">Closed</div>

            </div>

        </div>

    </div>


    {{-- RIWAYAT RESPON ADMIN --}}

    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                Riwayat Respon Admin

            </h5>

        </div>

        <div class="card-body">

            @forelse($complaint->responses as $response)

                <div class="card mb-3 border-start border-5 border-success">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <strong>

                                    {{ $response->responder_name }}

                                </strong>

                                <span class="badge bg-primary">

                                    {{ $response->responder_role }}

                                </span>

                            </div>

                            <small>

                                {{ $response->created_at->format('d M Y H:i') }}

                            </small>

                        </div>

                        <hr>

                        <p>

                            {{ $response->message }}

                        </p>

                        {{-- Foto Respon --}}

                        @if($response->attachment)

                            <img
                                src="{{ asset('storage/'.$response->attachment) }}"
                                class="img-fluid rounded shadow"
                                style="max-width:300px;">

                        @endif

                        @if($response->is_final)

                            <div class="mt-3">

                                <span class="badge bg-success">

                                    ✔ Respon Final

                                </span>

                            </div>

                        @endif

                    </div>

                </div>

            @empty

                <div class="alert alert-warning">

                    Belum ada respon dari Admin.

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection