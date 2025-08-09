<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'KawanKandang') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #0091ff;
            --primary-light: #36b4ff;
            --secondary-color: #5856d6;
            --accent-color: #ff375f;
            --success-color: #34c759;
            --warning-color: #ff9500;
            --info-color: #5ac8fa;
            --danger-color: #ff3b30;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            
            /* Background gradients */
            --bg-gradient-blue: linear-gradient(120deg, #00c6fb 0%, #005bea 100%);
            --bg-gradient-purple: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --bg-gradient-orange: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            --bg-gradient-green: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
            --bg-gradient-pink: linear-gradient(120deg, #f093fb 0%, #f5576c 100%);
        }
        
        /* Mengatasi masalah overflow pada mobile */
        html, body {
            overflow-x: hidden;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f0f7ff;
            color: #333;
        }
        
        .sidebar {
            min-height: 100vh;
            background: var(--bg-gradient-purple);
            color: white;
            box-shadow: 3px 0 15px rgba(0,0,0,0.15);
            /* border-radius: 0 15px 15px 0; */
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.08)"/></svg>');
            background-size: cover;
        }
        
        .sidebar h4 {
            background-color: rgba(0,0,0,0.15);
            padding: 18px;
            border-radius: 10px;
            margin-top: 10px;
            text-align: center;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        @media (max-width: 992px) {
            .sidebar {
                min-height: auto;
                border-radius: 0;
                position: fixed;
                top: 0;
                left: -100%;
                width: 250px;
                height: 100vh;
                z-index: 1050;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .sidebar h4 {
                font-size: 1.1rem;
                padding: 12px;
            }
            
            .sidebar-backdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1040;
            }
            
            .sidebar-backdrop.show {
                display: block;
            }
            
            .content {
                margin-left: 0;
                width: 100%;
            }
            
            /* Toggle button untuk sidebar */
            .sidebar-toggle {
                display: inline-block;
                background: transparent;
                border: none;
                color: white;
                font-size: 1.25rem;
                margin-right: 1rem;
                cursor: pointer;
            }
            
            .sidebar-close {
                position: absolute;
                top: 10px;
                right: 10px;
                background: rgba(255, 255, 255, 0.2);
                border: none;
                color: white;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                cursor: pointer;
                z-index: 1060;
            }
            
            .navbar-brand span {
                font-size: 0.9rem;
            }
        }
        
        .content {
            flex: 1;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            padding: 12px 18px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
            z-index: -1;
        }
        
        .nav-link:hover {
            color: white;
            transform: translateX(5px);
        }
        
        .nav-link:hover::before {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .active {
            color: white;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .active::before {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        header {
            background: var(--bg-gradient-blue) !important;
            color: white !important;
            padding: 18px 0 !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-bottom: none !important;
            position: relative;
            overflow: hidden;
            z-index: 1030;
        }
        
        header::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 30%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        header h4 {
            font-weight: 700;
            letter-spacing: 0.8px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }
        
        @media (max-width: 768px) {
            header h4 {
                font-size: 1.2rem;
            }
        }
        
        header a {
            color: white !important;
            position: relative;
            transition: all 0.3s ease;
        }
        
        header a:hover {
            transform: translateY(-3px);
        }
        
        .btn-primary {
            background: var(--bg-gradient-blue);
            border: none;
            box-shadow: 0 5px 15px rgba(0, 145, 255, 0.35);
            transition: all 0.3s ease;
            border-radius: 10px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 145, 255, 0.45);
        }
        
        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0, 145, 255, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(to right, var(--danger-color), #ff6b6b);
            border: none;
            box-shadow: 0 5px 15px rgba(255, 59, 48, 0.3);
            transition: all 0.3s ease;
            border-radius: 10px;
            font-weight: 500;
        }
        
        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 59, 48, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(to right, var(--success-color), #4cd964);
            border: none;
            box-shadow: 0 5px 15px rgba(52, 199, 89, 0.3);
            transition: all 0.3s ease;
            border-radius: 10px;
            font-weight: 500;
        }
        
        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(52, 199, 89, 0.4);
        }
        
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: white;
        }
        
        .card:hover {
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
            transform: translateY(-5px);
        }
        
        .card-header {
            background: var(--bg-gradient-blue);
            color: white;
            font-weight: 600;
            padding: 18px 25px;
            border-bottom: none;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
        }
        
        .card-header i {
            margin-right: 10px;
            font-size: 1.2em;
        }
        
        .card-body {
            padding: 30px;
        }
        
        @media (max-width: 768px) {
            .card-body {
                padding: 20px 15px;
            }
            
            .card-header {
                padding: 15px;
            }
        }
        
        .alert {
            border-radius: 12px;
            border: none;
        }
        
        /* Responsif untuk tabel */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Responsif untuk container */
        .container {
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        
        /* Responsif untuk pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            width: 100%;
            flex-wrap: wrap;
        }
        
        .pagination-container nav {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        
        .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 1rem 0;
            padding-left: 0;
            list-style: none;
        }
        
        .page-item {
            margin: 0.2rem;
        }
        
        .page-link {
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: var(--primary-color);
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .page-link:hover {
            z-index: 2;
            color: #fff;
            text-decoration: none;
            background-color: var(--primary-light);
            border-color: var(--primary-light);
            transform: translateY(-3px);
        }
        
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background: var(--bg-gradient-blue);
            border-color: var(--primary-color);
        }
        
        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
        }

        @media (max-width: 576px) {
            .btn {
                padding: 0.375rem 0.5rem;
                font-size: 0.875rem;
            }
            
            .table td, .table th {
                padding: 0.5rem;
            }
            
            .btn-sm {
                padding: 0.25rem 0.4rem;
                font-size: 0.75rem;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .card-header .btn {
                margin-top: 10px;
                align-self: flex-end;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
            }
            
            .d-flex.justify-content-between .btn {
                margin-top: 10px;
                align-self: flex-end;
            }
        }

        /* Perbaikan navbar pada mobile */
        @media (max-width: 576px) {
            header.navbar {
                padding: 10px 0 !important;
            }
            
            .navbar-brand {
                max-width: 70%;
            }
            
            .navbar-brand span {
                display: block;
                white-space: normal;
                line-height: 1.2;
            }
            
            .navbar-toggler {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
                position: relative;
                z-index: 1060;
            }
            
            .navbar-nav .nav-link {
                text-align: center;
                padding: 0.5rem;
            }
            
            /* Membuat container lebih rapi di mobile */
            .container {
                padding-right: 10px;
                padding-left: 10px;
            }
        }

        .navbar-collapse {
            z-index: 1050;
        }

        @media (max-width: 767.98px) {
            .navbar-collapse {
                background-color: var(--primary-color);
                border-radius: 0 0 15px 15px;
                padding: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                position: absolute;
                top: 100%;
                right: 0;
                left: 0;
                margin: 0 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar backdrop -->
    <div class="sidebar-backdrop"></div>
    
    <div class="container-fluid">
        <div class="row">
            @auth('admin')
            <!-- Sidebar (hanya muncul jika user sudah login) -->
            <div class="col-md-2 px-0 sidebar" id="sidebar">
                <button class="sidebar-close d-md-none" id="sidebarClose">
                    <i class="fas fa-times"></i>
                </button>
                <div class="p-3">
                    <h4 class="mb-4">Menu Admin</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gejala.*') ? 'active' : '' }}" href="{{ route('gejala.index') }}">
                                <i class="fas fa-list me-2"></i> Gejala
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('penyakit.*') ? 'active' : '' }}" href="{{ route('penyakit.index') }}">
                                <i class="fas fa-bug me-2"></i> Penyakit
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('rule.*') ? 'active' : '' }}" href="{{ route('rule.index') }}">
                                <i class="fas fa-cogs me-2"></i> Rule
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('diagnosis.riwayat') ? 'active' : '' }}" href="{{ route('diagnosis.riwayat') }}">
                                <i class="fas fa-history me-2"></i> Riwayat Diagnosis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('diagnosis.index') ? 'active' : '' }}" href="{{ route('diagnosis.index') }}">
                                <i class="fas fa-stethoscope me-2"></i> Diagnosis
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link bg-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 content p-0">
            @else
            <!-- Tanpa sidebar jika belum login -->
            <div class="col-md-12 content p-0">
            @endauth
                <!-- Header -->
                <header class="navbar navbar-expand-md navbar-dark mb-4">
                    <div class="container-fluid">
                        @auth('admin')
                        <button class="sidebar-toggle d-md-none" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        @endauth
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            <i class="fas fa-feather-alt me-2"></i>
                            <span>{{ config('app.name') }}</span>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                @guest('admin')
                                <li class="nav-item me-3">
                                    <a class="nav-link {{ request()->routeIs('diagnosis.index') ? 'active' : '' }}" href="{{ route('diagnosis.index') }}">
                                        <i class="fas fa-stethoscope me-1"></i> Diagnosis
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i> Login
                                    </a>
                                </li>
                                @else
                                <li class="nav-item me-3">
                                    <a class="nav-link {{ request()->routeIs('diagnosis.index') ? 'active' : '' }}" href="{{ route('diagnosis.index') }}">
                                        <i class="fas fa-stethoscope me-1"></i> Diagnosis
                                    </a>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </header>
                
                <!-- Flash Messages -->
                <div class="container">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                
                <!-- Content -->
                <main class="container py-4">
                    @yield('content')
                </main>
                
                <!-- Footer -->
                <footer class="mt-auto py-3 text-center">
                    <div class="container">
                        <p class="mb-0">
                            Copyright {{ date('Y') }} - {{ config('app.name') }}
                        </p>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script untuk sidebar mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const backdrop = document.querySelector('.sidebar-backdrop');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    if (sidebar) sidebar.classList.add('show');
                    if (backdrop) backdrop.classList.add('show');
                    document.body.style.overflow = 'hidden';
                });
            }
            
            if (sidebarClose) {
                sidebarClose.addEventListener('click', function() {
                    if (sidebar) sidebar.classList.remove('show');
                    if (backdrop) backdrop.classList.remove('show');
                    document.body.style.overflow = '';
                });
            }
            
            if (backdrop) {
                backdrop.addEventListener('click', function() {
                    if (sidebar) sidebar.classList.remove('show');
                    if (backdrop) backdrop.classList.remove('show');
                    document.body.style.overflow = '';
                });
            }
            
            // Tutup sidebar saat window resize ke desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    if (sidebar) sidebar.classList.remove('show');
                    if (backdrop) backdrop.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>
</html> 