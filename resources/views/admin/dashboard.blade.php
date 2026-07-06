@extends('layouts.admin')

@section('content')

<h3 class="mb-4 fw-bold">
    Dashboard Administrator
</h3>

<div class="row g-3">

    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">

    <div class="card shadow-sm border-0">

        <div class="card-body text-center py-3">

            <h6 class="text-muted mb-1">
                Total Pengaduan
            </h6>

            <h3 class="fw-bold text-primary mb-0">
                {{ $total }}
            </h3>

        </div>

    </div>

</div>

    <div class="col-md-2">

        <div class="card shadow border-0 bg-secondary text-white">

            <div class="card-body">

                <h6>Open</h6>

                <h2>{{ $open }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-2">

        <div class="card shadow border-0 bg-warning">

            <div class="card-body">

                <h6>Review</h6>

                <h2>{{ $review }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-2">

        <div class="card shadow border-0 bg-info text-white">

            <div class="card-body">

                <h6>Progress</h6>

                <h2>{{ $progress }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-2">

        <div class="card shadow border-0 bg-success text-white">

            <div class="card-body">

                <h6>Resolved</h6>

                <h2>{{ $resolved }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-2">

        <div class="card shadow border-0 bg-dark text-white">

            <div class="card-body">

                <h6>Closed</h6>

                <h2>{{ $closed }}</h2>

            </div>

        </div>

    </div>

</div>

<div class="row mt-4">

    <div class="col-md-6">

        <div class="card shadow-sm">

            <div class="card-header">

                Statistik Pengaduan

            </div>

            <div class="card-body">

                <canvas id="statusChart"
                style="max-height:300px;"></canvas>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card shadow border-0">

            <div class="card-header">

                Ringkasan

            </div>

            <div class="card-body">

                <table class="table">

                    <tr>
                        <td>Total Pengaduan</td>
                        <td>{{ $total }}</td>
                    </tr>

                    <tr>
                        <td>Pengaduan Selesai</td>
                        <td>{{ $resolved }}</td>
                    </tr>

                    <tr>
                        <td>Masih Diproses</td>
                        <td>{{ $progress }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="card shadow border-0 mt-4">

    <div class="card-header">

        Pengaduan Terbaru

    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>Kode</th>

                    <th>Foto</th>

                    <th>Judul</th>

                    <th>Pelapor</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @foreach($latest as $item)

                <tr>

                    <td>{{ $item->complaint_code }}</td>

                    <td>

                        @if($item->attachment)

                        <img src="{{ asset('storage/'.$item->attachment) }}"
                            width="70">

                        @endif

                    </td>

                    <td>{{ $item->title }}</td>

                    <td>{{ $item->complainant_name }}</td>

                    <td>

                        <span class="badge bg-{{ $item->status_badge }}">

                            {{ $item->status_label }}

                        </span>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    new Chart(document.getElementById('statusChart'), {

        type: 'doughnut',

        data: {

            labels: [
                'pending',
                'Open',
                'Review',
                'Progress',
                'Resolved',
                'Closed'
            ],

            datasets: [{

                labels: 'Jumlah Pengaduan',

                data: @json($chartData),

                borderWidth:1

            }]

        }

    });
</script>

@endsection