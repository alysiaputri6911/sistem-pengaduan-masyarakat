<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Admin | Sistem Pengaduan Masyarakat</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="d-flex">

        <!-- Sidebar -->

        <div
            class="bg-primary text-white"
            style="width:260px;min-height:100vh;">

            <div class="p-4">

                <h4 class="fw-bold">

                    SIMAS

                </h4>

                <small>

                    Sistem Pengaduan
                    Masyarakat

                </small>

            </div>

            <hr>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.complaints.index') }}" class="nav-link">
                        Pengaduan
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.responses.index') }}" class="nav-link">
                        Respon
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        User
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.reports.index') }}" class="nav-link">
                        Laporan
                    </a>
                </li>

            </ul>

        </div>

        <!-- Content -->

        <div class="flex-grow-1">

            <nav
                class="navbar navbar-expand-lg bg-white shadow-sm">

                <div class="container-fluid">

                    <span
                        class="fw-bold">

                        Dashboard Admin

                    </span>

                    <div>

                        {{ auth()->user()->name }}

                        |

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="d-inline">

                            @csrf

                            <button
                                class="btn btn-danger btn-sm">

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </nav>

            <div class="container-fluid p-4">

                @yield('content')

            </div>

        </div>

    </div>

</body>

</html>