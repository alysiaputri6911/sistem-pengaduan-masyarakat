@extends('layouts.admin')

@section('content')


<h3 class="mb-4">
    Data Pengaduan
</h3>

<form method="GET" class="row mb-3">

    <div class="col-md-3">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari..."

            value="{{ request('search') }}">

    </div>

    <div class="col-md-3">

        <select
            name="status"
            class="form-select">

            <option value="">Semua Status</option>

            <option value="open">Open</option>

            <option value="in_review">Review</option>

            <option value="in_progress">Progress</option>

            <option value="resolved">Resolved</option>

            <option value="closed">Closed</option>

        </select>

    </div>

    <div class="col-md-3">

        <button class="btn btn-primary">

            Filter

        </button>

    </div>

</form>

<table class="table table-bordered table-hover">

    <thead class="table-dark">

    <tr>

        <th>Kode</th>

        <th>Judul</th>

        <th>Foto</th>

        <th>Pelapor</th>

        <th>Prioritas</th>

        <th>Status</th>

        <th>Aksi</th>

    </tr>

    </thead>

    <tbody>

    @foreach($complaints as $item)

    <tr>

        <td>{{ $item->complaint_code }}</td>

        <td>{{ $item->title }}</td>

        <td>{{ $item->complainant_name }}</td>

        <td>{{ ucfirst($item->priority) }}</td>

        <td>{{ ucfirst($item->status) }}</td>

        <td>
@if($item->attachment)

<img src="{{ asset('storage/'.$item->attachment) }}"
     width="90"
     class="rounded border">

@else

-

@endif
</td>

        <td>

            <a
                href="{{ route('admin.complaints.show',$item->id) }}"
                class="btn btn-info btn-sm">

                Detail

            </a>

            

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

{{ $complaints->links() }}

@endsection