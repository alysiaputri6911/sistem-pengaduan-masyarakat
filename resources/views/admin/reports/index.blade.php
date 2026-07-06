@extends('layouts.admin')

@section('content')

<h3>Laporan Pengaduan</h3>

<table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
        <tr>
            <th>Kode</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Prioritas</th>
        </tr>
    </thead>

    <tbody>

        @foreach($complaints as $c)

        <tr>

            <td>{{ $c->complaint_code }}</td>

            <td>{{ $c->title }}</td>

            <td>{{ $c->status_label }}</td>

            <td>{{ $c->priority_label }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection