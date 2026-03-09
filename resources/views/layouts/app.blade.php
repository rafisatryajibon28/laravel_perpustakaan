<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'MyDigitalLibrary') - Perpustakaan Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.11.0/font/bootstrap-icons.css">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
        }

        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }

        .sidebar .nav-link {
            color: #495057;
            padding: 0.8rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.5rem;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            color: #0d6efd;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            padding: 20px;
            background-color: #fff;
        }

        .card-dashboard {
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-book-half text-primary"></i>
                MyDigitalLibrary
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bstarget="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-circle"></i>
                            @if (session('login'))
                                {{ session('username') }}
                            @else
                                Guest
                            @endif
                        </a>
                    </li>
                    @if (session('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                                onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 px-0 sidebar">
                <div class="nav flex-column p-3">
                    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                    <a href="/buku" class="nav-link {{ request()->is('buku*') ? 'active' : '' }}">
                        <i class="bi bi-book"></i> Data Buku
                    </a>
                    <a href="/anggota" class="nav-link {{ request()->is('anggota*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Data Anggota
                    </a>
                    <a href="/peminjaman" class="nav-link {{ request()->is('peminjaman*') ? 'active' : '' }}">
                        <i class="bi bi-arrow-left-right"></i> Peminjaman
                    </a>
                    <a href="/laporan/peminjaman" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                        <i class="bi bi-file-text"></i> Laporan
                    </a>
                </div>
            </div>
            <div class="col-md-10 main-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <h2 class="mb-4">@yield('page-title')</h2>
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>

</html>
