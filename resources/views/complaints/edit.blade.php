@extends('layouts.app')

@section('content')

<div class="card shadow border-0">

    <div class="card-header">

        Edit Pengaduan

    </div>

    <div class="card-body">

        <form action="{{ route('complaints.update', $complaint->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Judul -->

            <div class="mb-3">

                <label class="form-label">

                    Judul

                </label>

                <input
                    type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $complaint->title) }}">

                @error('title')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <!-- Kategori -->

            <div class="mb-3">

                <label class="form-label">

                    Kategori

                </label>

                <select
                    name="category"
                    class="form-control">

                    <option value="Infrastruktur"
                        {{ old('category',$complaint->category)=='Infrastruktur' ? 'selected' : '' }}>
                        Infrastruktur
                    </option>

                    <option value="Kebersihan"
                        {{ old('category',$complaint->category)=='Kebersihan' ? 'selected' : '' }}>
                        Kebersihan
                    </option>

                    <option value="Keamanan"
                        {{ old('category',$complaint->category)=='Keamanan' ? 'selected' : '' }}>
                        Keamanan
                    </option>

                </select>

            </div>

            <!-- Lokasi -->

            <div class="mb-3">

                <label class="form-label">

                    Lokasi

                </label>

                <input
                    type="text"
                    name="location"
                    class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location', $complaint->location) }}">

                @error('location')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <!-- Foto Lama -->

            @if($complaint->attachment)

            <div class="mb-3">

                <label class="form-label">

                    Foto Saat Ini

                </label>

                <br>

                <img
                    src="{{ asset('storage/'.$complaint->attachment) }}"
                    class="img-thumbnail"
                    style="max-width:300px">

            </div>

            @endif

            <!-- Upload Foto Baru -->

            <div class="mb-3">

                <label class="form-label">

                    Ganti Foto (Opsional)

                </label>

                <input
                    type="file"
                    name="attachment"
                    class="form-control"
                    accept="image/*">

                @error('attachment')

                    <small class="text-danger">

                        {{ $message }}

                    </small>

                @enderror

            </div>

            <!-- Deskripsi -->

            <div class="mb-3">

                <label class="form-label">

                    Deskripsi

                </label>

                <textarea
                    name="description"
                    rows="6"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description',$complaint->description) }}</textarea>

                @error('description')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Update Pengaduan

            </button>

            <a
                href="{{ route('complaints.index') }}"
                class="btn btn-secondary">

                Batal

            </a>

        </form>

    </div>

</div>

@endsection