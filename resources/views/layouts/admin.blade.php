<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Advisor.CF</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: white;
        }
        .sidebar a {
            color: rgba(255,255,255,.75);
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .sidebar a:hover, .sidebar a.active {
            color: white;
            background-color: rgba(255,255,255,.1);
        }
        .navbar-top {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="mb-4 text-center text-white"><i class="bi bi-cpu"></i> Admin Panel</h4>
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.kategori_framework.index') }}" class="{{ request()->routeIs('admin.kategori_framework.*') ? 'active' : '' }}"><i class="bi bi-tags me-2"></i> Kategori Framework</a></li>
                <li><a href="{{ route('admin.jenis_proyek.index') }}" class="{{ request()->routeIs('admin.jenis_proyek.*') ? 'active' : '' }}"><i class="bi bi-globe2 me-2"></i> Jenis Proyek</a></li>
                <li><a href="{{ route('admin.framework.index') }}" class="{{ request()->routeIs('admin.framework.*') ? 'active' : '' }}"><i class="bi bi-box me-2"></i> Framework</a></li>
                <li><a href="{{ route('admin.pertanyaan.index') }}" class="{{ request()->routeIs('admin.pertanyaan.*') ? 'active' : '' }}"><i class="bi bi-question-circle me-2"></i> Pertanyaan</a></li>
                <li><a href="{{ route('admin.opsi_jawaban.index') }}" class="{{ request()->routeIs('admin.opsi_jawaban.*') ? 'active' : '' }}"><i class="bi bi-card-checklist me-2"></i> Opsi Jawaban</a></li>
                <li><a href="{{ route('admin.knowledge_base.index') }}" class="{{ request()->routeIs('admin.knowledge_base.*') ? 'active' : '' }}"><i class="bi bi-diagram-3 me-2"></i> Knowledge Base</a></li>
                <li><a href="{{ route('admin.history.index') }}" class="{{ request()->routeIs('admin.history.*') ? 'active' : '' }}"><i class="bi bi-clock-history me-2"></i> Hasil Konsultasi</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand navbar-light navbar-top px-4 py-3">
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
