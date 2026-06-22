@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow border-0">

        <div class="card-header bg-warning">

            <h4 class="mb-0">

                Edit Pengaduan

            </h4>

        </div>

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form
                action="{{ route('complaints.update',$complaint->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">

                        Judul Pengaduan

                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title',$complaint->title) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Kategori

                    </label>

                    <select
                        name="category"
                        class="form-select">

                        <option value="Infrastruktur"
                            {{ $complaint->category == 'Infrastruktur' ? 'selected' : '' }}>

                            Infrastruktur

                        </option>

                        <option value="Kebersihan"
                            {{ $complaint->category == 'Kebersihan' ? 'selected' : '' }}>

                            Kebersihan

                        </option>

                        <option value="Keamanan"
                            {{ $complaint->category == 'Keamanan' ? 'selected' : '' }}>

                            Keamanan

                        </option>

                        <option value="Pelayanan Publik"
                            {{ $complaint->category == 'Pelayanan Publik' ? 'selected' : '' }}>

                            Pelayanan Publik

                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Lokasi Kejadian

                    </label>

                    <input
                        type="text"
                        name="location"
                        class="form-control"
                        value="{{ old('location',$complaint->location) }}">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Deskripsi Pengaduan

                    </label>

                    <textarea
                        name="description"
                        rows="6"
                        class="form-control"
                        required>{{ old('description',$complaint->description) }}</textarea>

                </div>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('complaints.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Update Pengaduan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection