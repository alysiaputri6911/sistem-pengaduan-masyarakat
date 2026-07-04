@extends('layouts.admin')

@section('content')

<h3>Detail User</h3>

<div class="card">

    <div class="card-body">

        <h5>{{ $user->name }}</h5>

        <p>Email : {{ $user->email }}</p>

        <p>Role : {{ ucfirst($user->role) }}</p>

    </div>

</div>

<h4 class="mt-4">

    Daftar Pengaduan

</h4>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Kode</th>

            <th>Judul</th>

            <th>Status</th>

            <th>Prioritas</th>

        </tr>

    </thead>

    <tbody>

        @forelse($user->complaints as $complaint)

        <tr>

            <td>{{ $complaint->complaint_code }}</td>

            <td>{{ $complaint->title }}</td>

            <td>

                <span class="badge bg-{{ $complaint->status_badge }}">

                    {{ $complaint->status_label }}

                </span>

            </td>

            <td>

                <span class="badge bg-{{ $complaint->priority_badge }}">

                    {{ $complaint->priority_label }}

                </span>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="4">

                Belum ada pengaduan.

            </td>

        </tr>

        @endforelse

    </tbody>

</table>

@endsection