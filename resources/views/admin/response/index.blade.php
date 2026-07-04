@extends('layouts.admin')

@section('content')

<h3>Data Respon</h3>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>No</th>

            <th>Pengaduan</th>

            <th>Admin</th>

            <th>Respon</th>

            <th>Tanggal</th>

        </tr>

    </thead>

    <tbody>

        @foreach($responses as $r)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $r->complaint->title }}</td>

            <td>{{ $r->responder_name }}</td>

            <td>{{ $r->message }}</td>

            <td>{{ $r->created_at->format('d-m-Y') }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection