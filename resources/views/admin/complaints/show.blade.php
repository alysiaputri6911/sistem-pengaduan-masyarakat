@extends('layouts.admin')

@section('content')

<div class="container">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="d-flex justify-content-between mb-3">

        <h3>

            Detail Pengaduan

        </h3>

        <a href="{{ route('admin.complaints.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>

    </div>

    <div class="card shadow mb-4">

        <div class="card-header bg-primary text-white">

            Informasi Pengaduan

        </div>

        <div class="card-body">

            <table class="table table-bordered">

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

                        No HP

                    </th>

                    <td>

                        {{ $complaint->phone }}

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

                        Lokasi

                    </th>

                    <td>

                        {{ $complaint->location }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Prioritas

                    </th>

                    <td>

                        <span class="badge bg-warning">

                            {{ ucfirst($complaint->priority) }}

                        </span>

                    </td>

                </tr>

                <tr>

                    <th>

                        Status

                    </th>

                    <td>

                        <span class="badge bg-info">

                            {{ ucfirst(str_replace('_',' ',$complaint->status)) }}

                        </span>

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


    @if($complaint->attachment)

    <div class="card shadow mb-4">

        <div class="card-header bg-success text-white">

            Bukti Foto Pengaduan

        </div>

        <div class="card-body text-center">

            <img
                src="{{ asset('storage/'.$complaint->attachment) }}"
                class="img-fluid rounded shadow"
                style="max-width:600px;">

        </div>

    </div>

    @endif


    <div class="card shadow mb-4">

        <div class="card-header bg-dark text-white">

            Respon Admin

        </div>

        <div class="card-body">

            <form
                action="{{ route('admin.complaints.response',$complaint->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label>

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-control">

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


                <div class="mb-3">

                    <label>

                        Prioritas

                    </label>

                    <select
                        name="priority"
                        class="form-control">

                        <option value="low"

                        {{ $complaint->priority=='low'?'selected':'' }}>

                            Low

                        </option>

                        <option value="medium"

                        {{ $complaint->priority=='medium'?'selected':'' }}>

                            Medium

                        </option>

                        <option value="high"

                        {{ $complaint->priority=='high'?'selected':'' }}>

                            High

                        </option>

                        <option value="critical"

                        {{ $complaint->priority=='critical'?'selected':'' }}>

                            Critical

                        </option>

                    </select>

                </div>


                <div class="mb-3">

                    <label>

                        Pesan Respon

                    </label>

                    <textarea
                        name="message"
                        rows="5"
                        class="form-control"
                        required></textarea>

                </div>


                <div class="mb-3">

                    <label>

                        Upload Foto Tindak Lanjut

                    </label>

                    <input
                        type="file"
                        name="attachment"
                        class="form-control">

                </div>


                <div class="form-check mb-3">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_final"
                        value="1">

                    <label>

                        Tandai sebagai Respon Final

                    </label>

                </div>


                <button
                    class="btn btn-primary">

                    Kirim Respon

                </button>

            </form>

        </div>

    </div>



    <div class="card shadow">

        <div class="card-header bg-secondary text-white">

            Riwayat Tracking Pengaduan

        </div>

        <div class="card-body">

            @forelse($complaint->responses as $response)

            <div class="border rounded p-3 mb-3">

                <h6>

                    {{ $response->responder_name }}

                    <span class="badge bg-dark">

                        {{ ucfirst($response->responder_role) }}

                    </span>

                </h6>

                <small class="text-muted">

                    {{ $response->created_at->format('d M Y H:i') }}

                </small>

                <hr>

                <p>

                    {{ $response->message }}

                </p>

                @if($response->attachment)

                    <img
                        src="{{ asset('storage/'.$response->attachment) }}"
                        class="img-fluid rounded"
                        style="max-width:350px;">

                    <br><br>

                @endif

                @if($response->is_final)

                    <span class="badge bg-success">

                        Respon Final

                    </span>

                @endif

            </div>

            @empty

                <div class="alert alert-warning">

                    Belum ada respon dari admin.

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection