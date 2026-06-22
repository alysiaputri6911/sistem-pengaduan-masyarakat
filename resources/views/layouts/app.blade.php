<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Sistem Pengaduan Masyarakat</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

</head>

<body class="bg-light">

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

        <div class="container">

            <a class="navbar-brand fw-bold">

                Sistem Pengaduan

            </a>

            <button class="navbar-toggler"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarMenu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse"
                 id="navbarMenu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <li class="nav-item">

    <a href="{{ route('complaints.index') }}"
       class="nav-link">

        Pengaduan Saya

    </a>

</li>

<li class="nav-item">

    <a href="{{ route('complaints.create') }}"
       class="nav-link">

        Buat Pengaduan

    </a>

</li>

                        <a href="{{ route('dashboard') }}"
                           class="nav-link">

                            Dashboard

                        </a>

                    </li>

                    <li class="nav-item">

                        <span class="nav-link">

                            {{ auth()->user()->name }}

                        </span>

                    </li>

                    <li class="nav-item">

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm mt-1">

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

    <!-- Content -->

    <div class="container mt-4">

        @yield('content')

    </div>

</body>

</html>