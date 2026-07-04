@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h3>Daftar User</h3>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<table class="table table-bordered table-hover">

    <thead class="table-dark">

        <tr>

            <th>No</th>

            <th>Nama</th>

            <th>Email</th>

            <th>Role</th>

            <th>Total Pengaduan</th>

            <th>Aksi</th>

        </tr>

    </thead>

    <tbody>

        @forelse($users as $user)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>

                @if($user->role=='admin')

                <span class="badge bg-danger">

                    Administrator

                </span>

                @else

                <span class="badge bg-success">

                    Citizen

                </span>

                @endif

            </td>

            <td>

                {{ $user->complaints_count }}

            </td>

            <td>

                <a href="{{ route('admin.users.show',$user) }}"
                    class="btn btn-info btn-sm">

                    Detail

                </a>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="6" class="text-center">

                Tidak ada data.

            </td>

        </tr>

        @endforelse

    </tbody>

</table>

{{ $users->links() }}

@endsection