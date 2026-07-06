@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold">
            Data Pengaduan
        </h3>

    </div>

    {{-- Filter --}}
    <form method="GET" class="row g-2 mb-4">

        <div class="col-md-4">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari kode, judul atau pelapor..."
                value="{{ request('search') }}">

        </div>

        <div class="col-md-3">

            <select
                name="status"
                class="form-select">

                <option value="">Semua Status</option>

                <option value="open"
                    {{ request('status')=='open' ? 'selected' : '' }}>
                    Open
                </option>

                <option value="in_review"
                    {{ request('status')=='in_review' ? 'selected' : '' }}>
                    Review
                </option>

                <option value="in_progress"
                    {{ request('status')=='in_progress' ? 'selected' : '' }}>
                    Progress
                </option>

                <option value="resolved"
                    {{ request('status')=='resolved' ? 'selected' : '' }}>
                    Resolved
                </option>

                <option value="closed"
                    {{ request('status')=='closed' ? 'selected' : '' }}>
                    Closed
                </option>

            </select>

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary w-100">

                Filter

            </button>

        </div>

        <div class="col-md-2">

            <a href="{{ route('admin.complaints.index') }}"
                class="btn btn-secondary w-100">

                Reset

            </a>

        </div>

    </form>

    {{-- Pesan --}}
    @if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>Kode</th>

                            <th>Judul</th>

                            <th>Foto</th>

                            <th>Pelapor</th>

                            <th>Prioritas</th>

                            <th>Status</th>

                            <th width="180">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($complaints as $item)

                        <tr>

                            <td>

                                {{ $item->complaint_code }}

                            </td>

                            <td>

                                {{ $item->title }}

                            </td>

                            <td>

                                @if($item->attachment)

                                <img
                                    src="{{ asset('storage/'.$item->attachment) }}"
                                    width="100"
                                    class="rounded border">

                                @else

                                <span class="text-muted">

                                    Tidak ada

                                </span>

                                @endif

                            </td>

                            <td>

                                {{ $item->complainant_name }}

                            </td>

                            <td>

                                <span class="badge bg-{{ $item->priority_badge }}">

                                    {{ $item->priority_label }}

                                </span>

                            </td>

                            <td>

                                <span class="badge bg-{{ $item->status_badge }}">

                                    {{ $item->status_label }}

                                </span>

                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.complaints.show',$item->id) }}"
                                    class="btn btn-info btn-sm">

                                    Detail

                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                Belum ada data pengaduan.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $complaints->links() }}

            </div>

        </div>

    </div>

</div>

@endsection