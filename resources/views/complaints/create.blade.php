@extends('layouts.app')

@section('content')

<div class="card shadow border-0">

    <div class="card-header">

        Buat Pengaduan

    </div>

    <div class="card-body">

        <form action="{{ route('complaints.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

            <div class="mb-3">

                <label>Judul</label>

                <input
                    type="text"
                    name="title"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Kategori</label>

                <select
                    name="category"
                    class="form-control">

                    <option>
                        Infrastruktur
                    </option>

                    <option>
                        Kebersihan
                    </option>

                    <option>
                        Keamanan
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label>Lokasi</label>

                <input
                    type="text"
                    name="location"
                    class="form-control">

            </div>

            <div class="mb-3">
    <label class="form-label">Foto Pengaduan</label>

    <input
        type="file"
        name="attachment"
        class="form-control"
        accept="image/*">

    @error('attachment')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

            <div class="mb-3">

                <label>Deskripsi</label>

                <textarea
                    name="description"
                    rows="5"
                    class="form-control"></textarea>

            </div>

            @if($complaint->attachment)

<hr>

<h5>Foto Pengaduan</h5>

<img
src="{{ asset('storage/'.$complaint->attachment) }}"
class="img-fluid rounded shadow">

@endif

            <button
                type="submit"
                class="btn btn-primary">

                Simpan

            </button>

        </form>

    </div>

</div>

@endsection