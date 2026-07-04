@extends('layouts.admin')

@section('content')

<h3>Data User</h3>

<table class="table table-striped">

    <thead>

        <tr>

            <th>Nama</th>

            <th>Email</th>

            <th>Role</th>

        </tr>

    </thead>

    <tbody>

        @foreach($users as $user)

        <tr>

            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>{{ ucfirst($user->role) }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection