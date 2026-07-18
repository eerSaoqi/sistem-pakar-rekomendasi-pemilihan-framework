<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Pakar Rekomendasi Framework')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom Theme Styles -->
    <style>
        :root {
            --bg-color: #FDE7DB; /* Champagne pink */
            --card-bg: #FFFFFF; /* White */
            --border-color: #FFC0CB; /* Pink */
            --primary-gradient: linear-gradient(135deg, #38DDCD 0%, #8FECD5 100%);
            --accent-gradient: linear-gradient(135deg, #F79AC4 0%, #FFC0CB 100%);
            --text-main: #2d3748; /* Dark Gray */
            --text-muted: #718096; /* Gray */
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        .card {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-main);
        }

        .navbar {
            background-color: #FFFFFF !important;
            border-bottom: 2px solid var(--border-color);
            padding: 1rem 0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.4rem;
        }

        .glass-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(255, 192, 203, 0.3), 0 4px 6px -2px rgba(255, 192, 203, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .glass-card:hover {
            box-shadow: 0 20px 25px -5px rgba(255, 192, 203, 0.4), 0 10px 10px -5px rgba(255, 192, 203, 0.2);
            transform: translateY(-2px);
        }

        .btn-gradient-primary {
            background: var(--primary-gradient);
            color: #1f2937;
            border: none;
            font-weight: 700;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: opacity 0.2s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(56, 221, 205, 0.3);
        }

        .btn-gradient-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            color: #1f2937;
        }

        .btn-gradient-accent {
            background: var(--accent-gradient);
            color: #ffffff;
            border: none;
            font-weight: 700;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: opacity 0.2s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(247, 154, 196, 0.3);
        }

        .btn-gradient-accent:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            color: #ffffff;
        }

        .form-control, .form-select {
            background-color: #FFFFFF;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus, .form-select:focus {
            background-color: #FFFFFF;
            border-color: #38DDCD;
            color: var(--text-main);
            box-shadow: 0 0 0 3px rgba(56, 221, 205, 0.25);
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        footer {
            margin-top: auto;
            background-color: #FFFFFF;
            border-top: 2px solid var(--border-color);
            padding: 1.5rem 0;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        /* Wizard form progress styling */
        .step-progress {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 2rem;
        }

        .step-progress::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--border-color);
            z-index: 1;
            transform: translateY(-50%);
        }

        .step-indicator {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #1f2937;
            border: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            z-index: 2;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }

        .step-indicator.active {
            background: var(--primary-gradient);
            border-color: transparent;
            color: #ffffff;
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.4);
        }

        .step-indicator.completed {
            background: #10b981;
            border-color: transparent;
            color: #ffffff;
        }

        /* Certainty factor scale style */
        .cf-selector {
            display: flex;
            gap: 10px;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .cf-option {
            flex: 1;
            min-width: 100px;
            background: var(--bg-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.85rem;
        }

        .cf-option:hover {
            border-color: #3b82f6;
            background: rgba(59, 130, 246, 0.05);
        }

        .cf-option.selected {
            background: var(--primary-gradient);
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 4px 10px rgba(139, 92, 246, 0.3);
        }

        /* Result percentage badge */
        .percentage-badge {
            background: var(--primary-gradient);
            font-weight: 800;
            font-size: 2.2rem;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-cpu-fill me-2"></i>Advisor.CF
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Konsultasi</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard Admin</a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-outline-light btn-sm px-3" href="{{ route('login') }}">
                                <i class="bi bi-person-fill me-1"></i>Admin Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="py-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-1">&copy; {{ date('Y') }} Advisor.CF - Sistem Pakar Rekomendasi Framework Pemrograman</p>
            <p class="mb-0 small">Berdasarkan Metode Certainty Factor &amp; Knowledge Base</p>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
