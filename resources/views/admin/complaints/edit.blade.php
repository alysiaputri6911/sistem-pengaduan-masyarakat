@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    Edit Pengaduan
                </h4>

                <a href="{{ route('admin.complaints.index') }}"
                   class="btn btn-light btn-sm">

                    Kembali

                </a>

            </div>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('admin.complaints.update',$complaint->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">

                        Kode Pengaduan

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $complaint->complaint_code }}"
                        readonly>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Judul

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $complaint->title }}"
                        readonly>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Pelapor

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $complaint->complainant_name }}"
                        readonly>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="open"
                            {{ $complaint->status=='open' ? 'selected':'' }}>
                            Open
                        </option>

                        <option value="in_review"
                            {{ $complaint->status=='in_review' ? 'selected':'' }}>
                            In Review
                        </option>

                        <option value="in_progress"
                            {{ $complaint->status=='in_progress' ? 'selected':'' }}>
                            In Progress
                        </option>

                        <option value="resolved"
                            {{ $complaint->status=='resolved' ? 'selected':'' }}>
                            Resolved
                        </option>

                        <option value="closed"
                            {{ $complaint->status=='closed' ? 'selected':'' }}>
                            Closed
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Prioritas

                    </label>

                    <select
                        name="priority"
                        class="form-select">

                        <option value="low"
                            {{ $complaint->priority=='low' ? 'selected':'' }}>
                            Low
                        </option>

                        <option value="medium"
                            {{ $complaint->priority=='medium' ? 'selected':'' }}>
                            Medium
                        </option>

                        <option value="high"
                            {{ $complaint->priority=='high' ? 'selected':'' }}>
                            High
                        </option>

                        <option value="critical"
                            {{ $complaint->priority=='critical' ? 'selected':'' }}>
                            Critical
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Deskripsi Pengaduan

                    </label>

                    <textarea
                        class="form-control"
                        rows="6"
                        readonly>{{ $complaint->description }}</textarea>

                </div>

                @if($complaint->attachment)

                    <div class="mb-3">

                        <label class="form-label">

                            Bukti Foto

                        </label>

                        <br>

                        <img
                            src="{{ asset('storage/'.$complaint->attachment) }}"
                            class="img-fluid rounded shadow"
                            style="max-width:400px;">

                    </div>

                @endif

                <button
                    type="submit"
                    class="btn btn-success">

                    Simpan Perubahan

                </button>

            </form>

        </div>

    </div>

</div>

@endsection