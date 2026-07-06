@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- Alert Success --}}
    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle-fill"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

    @endif

    {{-- Alert Error --}}
    @if($errors->any())

    <div class="alert alert-danger">

        <strong>

            Terjadi kesalahan

        </strong>

        <hr>

        <ul class="mb-0">

            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif


    {{-- Header --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold">

                Detail Pengaduan

            </h3>

            <small class="text-muted">

                Detail informasi laporan masyarakat

            </small>

        </div>

        <a
            href="{{ route('admin.complaints.index') }}"
            class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>


    {{-- Progress Status --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-info text-white">

            <i class="bi bi-diagram-3"></i>

            Progress Status

        </div>

        <div class="card-body">

            @php

            $step=1;

            switch($complaint->status){

            case 'open':

            $step=1;

            break;

            case 'in_review':

            $step=2;

            break;

            case 'in_progress':

            $step=3;

            break;

            case 'resolved':

            $step=4;

            break;

            case 'closed':

            $step=5;

            break;

            }

            @endphp

            <div class="progress mb-3" style="height:28px;">

                <div

                    class="progress-bar progress-bar-striped progress-bar-animated"

                    style="width:{{ $step*20 }}%">

                    {{ $complaint->status_label }}

                </div>

            </div>

            <div class="row text-center">

                <div class="col">

                    Open

                </div>

                <div class="col">

                    Review

                </div>

                <div class="col">

                    Progress

                </div>

                <div class="col">

                    Resolved

                </div>

                <div class="col">

                    Closed

                </div>

            </div>

        </div>

    </div>


    {{-- Informasi Pengaduan --}}

    <div class="card shadow border-0 mb-4">

        <div class="card-header bg-primary text-white">

            <i class="bi bi-file-earmark-text"></i>

            Informasi Pengaduan

        </div>

        <div class="card-body">

            <table class="table table-bordered align-middle">

                <tr>

                    <th width="220">

                        Kode Pengaduan

                    </th>

                    <td>

                        {{ $complaint->complaint_code }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Judul

                    </th>

                    <td>

                        {{ $complaint->title }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Pelapor

                    </th>

                    <td>

                        {{ $complaint->complainant_name }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Email

                    </th>

                    <td>

                        {{ $complaint->email }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Nomor HP

                    </th>

                    <td>

                        {{ $complaint->phone }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Lokasi

                    </th>

                    <td>

                        {{ $complaint->location }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Kategori

                    </th>

                    <td>

                        {{ $complaint->category }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Prioritas

                    </th>

                    <td>

                        <span class="badge bg-{{ $complaint->priority_badge }} fs-6">

                            {{ $complaint->priority_label }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>

                        Status

                    </th>

                    <td>

                        <span class="badge bg-{{ $complaint->status_badge }} fs-6">

                            {{ $complaint->status_label }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>

                        Tanggal Pengaduan

                    </th>

                    <td>

                        {{ $complaint->created_at->format('d F Y H:i') }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Deskripsi

                    </th>

                    <td>

                        {{ $complaint->description }}

                    </td>

                </tr>

            </table>

        </div>

    </div>


    {{-- Foto Pengaduan --}}

    @if($complaint->attachment)

    <div class="card shadow border-0 mb-4">

        <div class="card-header bg-success text-white">

            <i class="bi bi-image"></i>

            Bukti Foto Pengaduan

        </div>

        <div class="card-body text-center">

            <img

                src="{{ asset('storage/'.$complaint->attachment) }}"

                class="img-fluid rounded shadow"

                style="max-height:500px;">

        </div>

    </div>

    @endif


    {{-- =========================
    FORM RESPON ADMIN
========================= --}}

    <div class="card shadow border-0 mb-4">

        <div class="card-header bg-dark text-white">

            <i class="bi bi-chat-left-text-fill"></i>

            Form Respon Admin

        </div>

        <div class="card-body">

            <form
                action="{{ route('admin.complaints.response',$complaint->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- Status --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">

                            Status Pengaduan

                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required>

                            <option value="open"
                                {{ $complaint->status=='open'?'selected':'' }}>
                                Open
                            </option>

                            <option value="in_review"
                                {{ $complaint->status=='in_review'?'selected':'' }}>
                                In Review
                            </option>

                            <option value="in_progress"
                                {{ $complaint->status=='in_progress'?'selected':'' }}>
                                In Progress
                            </option>

                            <option value="resolved"
                                {{ $complaint->status=='resolved'?'selected':'' }}>
                                Resolved
                            </option>

                            <option value="closed"
                                {{ $complaint->status=='closed'?'selected':'' }}>
                                Closed
                            </option>

                        </select>

                    </div>

                    {{-- Prioritas --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">

                            Prioritas

                        </label>

                        <select
                            name="priority"
                            class="form-select"
                            required>

                            <option value="low"
                                {{ $complaint->priority=='low'?'selected':'' }}>
                                Rendah
                            </option>

                            <option value="medium"
                                {{ $complaint->priority=='medium'?'selected':'' }}>
                                Sedang
                            </option>

                            <option value="high"
                                {{ $complaint->priority=='high'?'selected':'' }}>
                                Tinggi
                            </option>

                            <option value="critical"
                                {{ $complaint->priority=='critical'?'selected':'' }}>
                                Kritis
                            </option>

                        </select>

                    </div>

                </div>

                {{-- Pesan --}}

                <div class="mb-3">

                    <label class="form-label fw-bold">

                        Pesan Respon

                    </label>

                    <textarea
                        name="message"
                        rows="6"
                        class="form-control"
                        placeholder="Tulis respon kepada pelapor..."
                        required>{{ old('message') }}</textarea>

                </div>

                {{-- Upload Foto --}}

                <div class="mb-3">

                    <label class="form-label fw-bold">

                        Upload Foto Tindak Lanjut

                    </label>

                    <input
                        type="file"
                        class="form-control"
                        name="attachment"
                        accept="image/*"
                        onchange="previewImage(event)">

                    <small class="text-muted">

                        Format JPG, PNG, JPEG maksimal 2 MB.

                    </small>

                </div>

                {{-- Preview Foto --}}

                <div class="mb-3 text-center">

                    <img
                        id="preview"
                        class="img-fluid rounded shadow"
                        style="display:none;max-height:250px;">

                </div>

                {{-- Final Response --}}

                <div class="form-check form-switch mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="1"
                        name="is_final"
                        id="final">

                    <label
                        class="form-check-label"
                        for="final">

                        Tandai sebagai Respon Final

                    </label>

                </div>

                {{-- Tombol --}}

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-send-fill"></i>

                        Kirim Respon

                    </button>

                    <button
                        type="reset"
                        class="btn btn-secondary">

                        <i class="bi bi-arrow-clockwise"></i>

                        Reset

                    </button>

                    <a
                        href="{{ route('admin.complaints.index') }}"
                        class="btn btn-danger">

                        <i class="bi bi-x-circle"></i>

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

    {{-- Preview Upload --}}

    <script>
        function previewImage(event) {

            let reader = new FileReader();

            reader.onload = function() {

                let output = document.getElementById('preview');

                output.src = reader.result;

                output.style.display = 'block';

            }

            reader.readAsDataURL(event.target.files[0]);

        }
    </script>



   {{-- ==========================================
        RIWAYAT TRACKING PENGADUAN
========================================== --}}

<div class="card shadow border-0">

    <div class="card-header bg-secondary text-white">

        <i class="bi bi-clock-history"></i>

        Riwayat Tracking Pengaduan

    </div>

    <div class="card-body">

        @forelse($complaint->responses as $response)

        <div class="card border-start border-4 border-primary shadow-sm mb-4">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h5 class="mb-1">

                            <i class="bi bi-person-circle"></i>

                            {{ $response->responder_name }}

                        </h5>

                        <small class="text-muted">

                            {{ $response->created_at->format('d F Y H:i') }}

                        </small>

                    </div>

                    <div>

                        <span class="badge bg-dark">

                            {{ $response->responder_role }}

                        </span>

                    </div>

                </div>

                <hr>

                <h6 class="text-primary">

                    Pesan Admin

                </h6>

                <p>

                    {{ $response->message }}

                </p>

                @if($response->attachment)

                <div class="mb-3">

                    <strong>

                        Foto Tindak Lanjut

                    </strong>

                    <br>

                    <img
                        src="{{ asset('storage/'.$response->attachment) }}"
                        class="img-fluid rounded shadow mt-2"
                        style="max-height:300px;">

                </div>

                @endif

                @if($response->is_final)

                <span class="badge bg-success">

                    <i class="bi bi-check-circle-fill"></i>

                    Respon Final

                </span>

                @endif

            </div>

        </div>

        @empty

        <div class="alert alert-warning text-center">

            <i class="bi bi-exclamation-circle"></i>

            Belum ada respon dari Admin.

        </div>

        @endforelse

    </div>

</div>

</div>

@endsection