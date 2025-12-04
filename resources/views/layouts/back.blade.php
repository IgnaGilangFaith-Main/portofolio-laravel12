<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>
    <link rel="shortcut icon" href="{{ asset('icon/icon.png') }}" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('back/css/layout.css') }}">
    @stack('styles')
</head>

<body>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ url('/dashboard') }}" class="sidebar-brand">
                <i class="bi bi-hexagon-fill"></i>
                <span>Panel Admin</span>
            </a>
            <button class="sidebar-toggle d-none d-lg-block" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <button class="sidebar-toggle d-lg-none" id="sidebarClose">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <!-- Main Menu -->
            <div class="nav-section">
                <div class="nav-section-title">Menu Utama</div>
            </div>

            <a href="{{ url('/dashboard') }}" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <!-- Manajemen Konten Portfolio -->
            <div class="nav-section">
                <div class="nav-section-title">Manajemen Konten</div>
            </div>

            <a href="{{ url('/hero') }}" class="sidebar-link {{ request()->is('hero*') ? 'active' : '' }}">
                <i class="bi bi-person-vcard"></i>
                <span>Bagian Hero</span>
            </a>

            <a href="{{ url('/about') }}" class="sidebar-link {{ request()->is('about*') ? 'active' : '' }}">
                <i class="bi bi-person-vcard"></i>
                <span>Tentang Saya</span>
            </a>

            <a href="{{ url('/skill') }}" class="sidebar-link {{ request()->is('skill*') ? 'active' : '' }}">
                <i class="bi bi-person-vcard"></i>
                <span>Keahlian</span>
            </a>

            <a href="{{ url('/project') }}" class="sidebar-link {{ request()->is('project*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i>
                <span>Proyek</span>
            </a>

            <!-- Users & Settings -->
            <div class="nav-section">
                <div class="nav-section-title">Pengaturan</div>
            </div>

            <a href="{{ url('/pengaturan-akun') }}"
                class="sidebar-link {{ request()->is('pengaturan-akun*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>Pengaturan Akun</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper" id="mainWrapper">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="container-fluid h-100">
                <div class="row align-items-center h-100">
                    <div class="col-auto d-lg-none">
                        <button class="btn btn-link text-dark p-0" id="sidebarOpen">
                            <i class="bi bi-list fs-4"></i>
                        </button>
                    </div>

                    <div class="col">
                    </div>

                    <div class="col-auto">
                        <div class="d-flex align-items-center gap-3">

                            <!-- User Menu -->
                            <div class="dropdown">
                                <button class="btn btn-link text-dark p-0 d-flex align-items-center gap-2"
                                    data-bs-toggle="dropdown">
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                    <i class="bi bi-chevron-down small"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end shadow">
                                    <div class="px-3 py-2 border-bottom">
                                        <p class="mb-0 fw-semibold">{{ Auth::user()->name }}</p>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                    <a class="dropdown-item" href="{{ url('/pengaturan-akun') }}">
                                        <i class="bi bi-gear me-2"></i>Pengaturan Akun
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ url('/logout') }}">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Page Header -->
            @hasSection('page-header')
                <div class="page-header">
                    @yield('page-header')
                </div>
            @else
                <div class="page-header">
                    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="dashboard-footer">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="text-muted small">
                    &copy; {{ date('Y') }} Gilang Risky Mahardika. All rights reserved.
                </div>
                <div class="text-muted small">
                    Version 1.0.0
                </div>
            </div>
        </footer>
    </div>

    {{-- Modals --}}
    @yield('modals')

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('back/js/layout.js') }}"></script>
    @stack('scripts')
</body>

</html>
