@extends('layouts.app')

@section('content')

<div class="card shadow border-0">

    <div class="card-header">

        Buat Pengaduan

    </div>

    <div class="card-body">

        <form
            action="{{ route('complaints.store') }}"
            method="POST">

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

                <label>Deskripsi</label>

                <textarea
                    name="description"
                    rows="5"
                    class="form-control"></textarea>

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Simpan

            </button>

        </form>

    </div>

</div>

@endsection