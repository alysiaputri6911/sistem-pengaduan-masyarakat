@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="mb-0">
            Data Respon Pengaduan
        </h3>

    </div>

    @if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="60">No</th>

                            <th>Kode</th>

                            <th>Judul Pengaduan</th>

                            <th>Admin</th>

                            <th>Respon</th>

                            <th>Final</th>

                            <th>Tanggal</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($responses as $r)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $r->complaint->complaint_code ?? '-' }}</td>

                            <td>{{ $r->complaint->title ?? '-' }}</td>

                            <td>{{ $r->responder_name }}</td>

                            <td>{{ $r->message }}</td>

                            <td>

                                @if($r->is_final)

                                <span class="badge bg-success">
                                    Ya
                                </span>

                                @else

                                <span class="badge bg-secondary">
                                    Tidak
                                </span>

                                @endif

                            </td>

                            <td>{{ $r->created_at->format('d-m-Y H:i') }}</td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted">

                                Belum ada respon pengaduan.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $responses->links() }}

            </div>

        </div>

    </div>

</div>

@endsection