@extends('layouts.admin')

@section('content')

<h3>

Detail Pengaduan

</h3>

<div class="card mb-4">

<div class="card-body">

<h4>

{{ $complaint->title }}

</h4>

<p>

{{ $complaint->description }}

</p>

<hr>

<strong>

Pelapor :

</strong>

{{ $complaint->complainant_name }}

<br>

<strong>

Status

</strong>

{{ ($complaint->status) }}

<br>

<strong>

Prioritas

</strong>

{{ ($complaint->priority) }}

</div>

</div>

@if($complaint->attachment)

<div class="card mb-4 shadow-sm">

    <div class="card-header bg-info text-white">

        <h5 class="mb-0">

            Bukti Foto Pengaduan

        </h5>

    </div>

    <div class="card-body text-center">

        <img
            src="{{ asset('storage/'.$complaint->attachment) }}"
            class="img-fluid rounded shadow"
            style="max-width:500px;">

    </div>

</div>

@endif

<div class="card">

<div class="card-header">

Tambah Respon

</div>

<div class="card-body">

<form

method="POST"

action="{{ route('admin.complaints.response',$complaint) }}">

@csrf

<div class="mb-3">

<textarea

name="message"

class="form-control"

rows="5"

required></textarea>

</div>

<div class="form-check mb-3">

<input

class="form-check-input"

type="checkbox"

name="is_final">

<label>

Respon Final

</label>

</div>

<button

class="btn btn-primary">

Kirim Respon

</button>

</form>

</div>

</div>

<hr>

<h4>

Riwayat Respon

</h4>

@foreach($complaint->responses as $response)

<div class="card mb-3">

<div class="card-body">

<strong>

{{ $response->responder_name }}

</strong>

<small>

{{ $response->created_at }}

</small>

<p>

{{ $response->message }}

</p>

@if($response->is_final)

<span class="badge bg-success">

Final

</span>

@endif

</div>

</div>

@endforeach

@endsection