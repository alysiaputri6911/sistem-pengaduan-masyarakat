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
                <table class="table table-hover align-middle text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($complaints as $item)

                        <tr>

                            <td>
                                {{ $item->complaint_code }}
                            </td>

                            <td class="text-start">
                                {{ $item->title }}
                            </td>

                            <td>
                                {{ $item->category }}
                            </td>

                            <td>

                                @if($item->attachment)

                                <img src="{{ asset('storage/'.$item->attachment) }}"
                                    width="80"
                                    height="60"
                                    class="rounded shadow-sm border"
                                    style="object-fit:cover;">

                                @else

                                <span class="text-muted">
                                    Tidak ada
                                </span>

                                @endif

                            </td>

                            <td>

                                @if($item->priority=='low')
                                <span class="badge bg-secondary">Low</span>

                                @elseif($item->priority=='medium')
                                <span class="badge bg-warning text-dark">Medium</span>

                                @elseif($item->priority=='high')
                                <span class="badge bg-danger">High</span>

                                @else
                                <span class="badge bg-dark">Critical</span>

                                @endif

                            </td>

                            <td>

                                @switch($item->status)

                                @case('pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                                @break

                                @case('open')
                                <span class="badge bg-primary">Open</span>
                                @break

                                @case('in_review')
                                <span class="badge bg-info">Review</span>
                                @break

                                @case('in_progress')
                                <span class="badge bg-secondary">Proses</span>
                                @break

                                @case('resolved')
                                <span class="badge bg-success">Selesai</span>
                                @break

                                @case('closed')
                                <span class="badge bg-dark">Closed</span>
                                @break

                                @endswitch

                            </td>

                            <td>
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                            <td>

                                <a href="{{ route('complaints.show',$item) }}"
                                    class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('complaints.edit',$item) }}"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('complaints.destroy',$item) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">

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