<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengaduan Masyarakat</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Sistem Pengaduan
        </a>

        <div class="ms-auto">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">
                    Dashboard
                </a>

                <a href="{{ route('complaints.index') }}" class="btn btn-light btn-sm">
                    Pengaduan Saya
                </a>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

</body>
</html>