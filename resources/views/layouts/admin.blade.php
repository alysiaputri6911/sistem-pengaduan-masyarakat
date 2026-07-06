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
            class="bg-primary text-white shadow"
            style="width:260px;min-height:100vh;">

            <div class="p-4 text-center">

                <h4 class="fw-bold text-white mb-0">
                    SIMAS
                </h4>

                <small class="text-white">
                    Sistem Pengaduan Masyarakat
                </small>

            </div>

            <hr class="border-light">

            <ul class="nav flex-column px-2">

                <li class="nav-item mb-2">

                    <a href="{{ route('dashboard') }}"
                        class="nav-link text-white fw-semibold rounded py-2 px-3"
                        style="display:flex;align-items:center;">

                        <i class="bi bi-speedometer2 me-2"></i>

                        <span>Dashboard</span>

                    </a>

                </li>

                <li class="nav-item mb-2">

                    <a href="{{ route('admin.complaints.index') }}"
                        class="nav-link text-white fw-semibold rounded py-2 px-3"
                        style="display:flex;align-items:center;">

                        <i class="bi bi-file-earmark-text me-2"></i>

                        <span>Pengaduan</span>

                    </a>

                </li>

                <li class="nav-item mb-2">

                    <a href="{{ route('admin.responses.index') }}"
                        class="nav-link text-white fw-semibold rounded py-2 px-3"
                        style="display:flex;align-items:center;">

                        <i class="bi bi-chat-dots me-2"></i>

                        <span>Respon</span>

                    </a>

                </li>

                <li class="nav-item mb-2">

                    <a href="{{ route('users.index') }}"
                        class="nav-link text-white fw-semibold rounded py-2 px-3"
                        style="display:flex;align-items:center;">

                        <i class="bi bi-people me-2"></i>

                        <span>User</span>

                    </a>

                </li>

                <li class="nav-item mb-2">

                    <a href="{{ route('admin.reports.index') }}"
                        class="nav-link text-white fw-semibold rounded py-2 px-3"
                        style="display:flex;align-items:center;">

                        <i class="bi bi-bar-chart-line me-2"></i>

                        <span>Laporan</span>

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