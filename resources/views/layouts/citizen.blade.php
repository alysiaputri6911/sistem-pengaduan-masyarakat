<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Citizen</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <span
            class="navbar-brand">

            Sistem Pengaduan

        </span>

        <div>

            {{ auth()->user()->name }}

        </div>

    </div>

</nav>

<div class="container mt-4">

    @yield('content')

</div>

</body>

</html>