@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    Detail Pengaduan
                </h4>

                <a href="{{ route('complaints.index') }}"
                   class="btn btn-light btn-sm">

                    Kembali

                </a>

            </div>

        </div>

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Kode Pengaduan</strong>
                </div>

                <div class="col-md-8">
                    {{ $complaint->complaint_code }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Judul</strong>
                </div>

                <div class="col-md-8">
                    {{ $complaint->title }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Kategori</strong>
                </div>

                <div class="col-md-8">
                    {{ $complaint->category }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Lokasi</strong>
                </div>

                <div class="col-md-8">
                    {{ $complaint->location }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Nama Pelapor</strong>
                </div>

                <div class="col-md-8">
                    {{ $complaint->complainant_name }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>No HP</strong>
                </div>

                <div class="col-md-8">
                    {{ $complaint->phone }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Email</strong>
                </div>

                <div class="col-md-8">
                    {{ $complaint->email }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Prioritas</strong>
                </div>

                <div class="col-md-8">

                    <span class="badge bg-{{ $complaint->priority_badge }}">
                        {{ $complaint->priority_label }}
                    </span>

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Status</strong>
                </div>

                <div class="col-md-8">

                    <span class="badge bg-{{ $complaint->status_badge }}">
                        {{ $complaint->status_label }}
                    </span>

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <strong>Tanggal Pengaduan</strong>
                </div>

                <div class="col-md-8">
                    {{ $complaint->created_at->format('d M Y H:i') }}
                </div>

            </div>

            <hr>

            <h5>Deskripsi Pengaduan</h5>

            <div class="alert alert-light border">

                {{ $complaint->description }}

            </div>

            @if($complaint->attachment)

<hr>

<h5>Foto Pengaduan</h5>

<img
src="{{ asset('storage/'.$complaint->attachment) }}"
class="img-fluid rounded shadow">

@endif

        </div>

    </div>

    {{-- Respon Admin --}}

    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                Riwayat Tanggapan

            </h5>

        </div>

        <div class="card-body">

            @forelse($complaint->responses as $response)

                <div class="border rounded p-3 mb-3">

                    <div class="d-flex justify-content-between">

                        <div>

                            <strong>
                                {{ $response->responder_name }}
                            </strong>

                            <span class="badge bg-info">

                                {{ $response->responder_role }}

                            </span>

                        </div>

                        <small>

                            {{ $response->created_at->format('d M Y H:i') }}

                        </small>

                    </div>

                    <hr>

                    <p class="mb-0">

                        {{ $response->message }}

                    </p>

                </div>

            @empty

                <div class="alert alert-warning">

                    Belum ada tanggapan dari admin.

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection