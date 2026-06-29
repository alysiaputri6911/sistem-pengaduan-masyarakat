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

                            <th>No</th>

                            <th>Judul</th>

                            <th>Kategori</th>

                            <th>Status</th>

                            <th>Tanggal</th>

                            <th width="180">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($complaints as $complaint)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                <strong>
                                    {{ $complaint->title }}
                                </strong>

                                <br>

                                <small class="text-muted">

                                    {{ Str::limit($complaint->description,60) }}

                                </small>

                            </td>

                            <td>

                                {{ $complaint->category }}

                            </td>

                            <td>

                                @if($complaint->status=='open')

                                    <span class="badge bg-warning text-dark">
                                        Open
                                    </span>

                                @elseif($complaint->status=='progress')

                                    <span class="badge bg-info">
                                        Progress
                                    </span>

                                @elseif($complaint->status=='resolved')

                                    <span class="badge bg-success">
                                        Resolved
                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        {{ $complaint->status }}

                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $complaint->created_at->format('d M Y') }}

                            </td>

                            <td>

                                <a href="{{ route('complaints.show',$complaint->id) }}"
                                    class="btn btn-sm btn-info text-white">

                                    Detail

                                </a>

                                <form
                                    action="{{ route('complaints.destroy',$complaint->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus pengaduan ini?')">

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