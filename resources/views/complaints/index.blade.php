@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Pengaduan Saya</h2>
            <p class="text-muted mb-0">
                Daftar seluruh pengaduan yang telah Anda buat.
            </p>
        </div>

        <a href="{{ route('complaints.create') }}" class="btn btn-primary">
            + Buat Pengaduan
        </a>
    </div>

    {{-- Pesan Berhasil --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">

        {{ session('success') }}

        <button class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>
    @endif

    <div class="card shadow-sm border-0">

        <div class="card-body">

            @if($complaints->count())

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>Kode</th>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Tanggal</th>



                            <th width="180">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($complaints as $item)

                        <tr>

                            <td>{{ $complaint->complaint_code }}</td>

                            <td>{{ $loop->iteration }}</td>

                            <!-- Judul -->
                            <td>
                                {{ $complaint->title }}
                            </td>

                            <!-- Kategori -->
                            <td>
                                {{ $complaint->category }}
                            </td>

                            <!-- Foto -->
                            <td>
                                @if($item->attachment)
                                <img src="{{ asset('storage/'.$item->attachment) }}"
                                    width="90"
                                    class="rounded border">
                                @else
                                -
                                @endif
                            </td>

                            <td>{{ $item->complainant_name }}</td>

                            <td>
                                <span class="badge bg-danger">
                                    {{ ucfirst($item->priority) }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    {{ ucfirst(str_replace('_',' ',$item->status)) }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td>

                                <span class="badge bg-warning text-dark">

                                    {{ $complaint->status }}

                                </span>

                            </td>

                            <!-- Tanggal -->
                            <td>

                                {{ $complaint->created_at->format('d M Y') }}

                            </td>

                            <!-- Aksi -->
                            <td>

                                <a href="{{ route('complaints.show',$complaint) }}"
                                    class="btn btn-info btn-sm">

                                    Detail

                                </a>

                                <a href="{{ route('complaints.edit',$complaint->id) }}"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('complaints.destroy',$complaint) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm">

                                        Hapus

                                    </button>

                                </form>



                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @else

            <div class="text-center py-5">

                <h5 class="text-muted">

                    Belum ada pengaduan.

                </h5>

                <a href="{{ route('complaints.create') }}"
                    class="btn btn-primary mt-3">

                    Buat Pengaduan Pertama

                </a>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection