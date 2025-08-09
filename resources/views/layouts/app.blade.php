<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="KawanKandang - Sistem Pendukung Keputusan untuk deteksi dini penyakit pada ayam broiler. Diagnosis akurat dengan algoritma forward chaining untuk kesehatan ternak yang optimal.">
    <meta name="keywords" content="KawanKandang, diagnosis penyakit ayam, ayam broiler, sistem pakar, forward chaining, kesehatan ternak">
    <meta name="author" content="KawanKandang Team">
    <title>{{ config('app.name', 'KawanKandang') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Modern Minimalist Color Palette */
            --primary-color: #6366f1;
            --primary-light: #a5b4fc;
            --primary-dark: #4338ca;
            --secondary-color: #64748b;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            
            /* Neutral Colors */
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            /* Background Colors */
            --bg-primary: #ffffff;
            --bg-secondary: var(--gray-50);
            --bg-tertiary: var(--gray-100);
            
            /* Text Colors */
            --text-primary: var(--gray-900);
            --text-secondary: var(--gray-600);
            --text-muted: var(--gray-500);
            
            /* Border & Shadow */
            --border-color: var(--gray-200);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            
            /* Spacing */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-2xl: 3rem;
            
            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
        }
        
        /* Modern Minimalist Base Styles */
        html, body {
            overflow-x: hidden;
        }
        
        body {
            font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            line-height: 1.6;
            font-weight: 400;
            letter-spacing: -0.01em;
        }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 500;
            letter-spacing: -0.025em;
            color: var(--text-primary);
            margin-bottom: var(--spacing-md);
        }
        
        p {
            color: var(--text-secondary);
            margin-bottom: var(--spacing-md);
        }
        
        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
        }
        
        .sidebar {
            min-height: 100vh;
            background: var(--bg-primary);
            color: var(--text-primary);
            border-right: 1px solid var(--border-color);
            position: relative;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }
        
        .sidebar h4 {
            background-color: var(--bg-tertiary);
            padding: var(--spacing-lg);
            border-radius: var(--radius-lg);
            margin: var(--spacing-lg);
            text-align: center;
            font-weight: 600;
            letter-spacing: -0.025em;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
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
            color: var(--text-secondary);
            border-radius: var(--radius-md);
            margin-bottom: var(--spacing-xs);
            transition: all 0.2s ease;
            padding: var(--spacing-md) var(--spacing-lg);
            position: relative;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }
        
        .nav-link:hover {
            color: var(--primary-color);
            background-color: var(--bg-tertiary);
            text-decoration: none;
        }
        
        .nav-link.active {
            color: #ffffff;
            background-color: var(--primary-color);
            font-weight: 600;
            border-radius: var(--radius-md);
        }
        
        .nav-link i {
            width: 20px;
            text-align: center;
            opacity: 0.8;
        }
        
        /* Header Styles */
        header {
            background: var(--bg-primary) !important;
            color: var(--text-primary) !important;
            padding: var(--spacing-lg) 0 !important;
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--border-color);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            text-decoration: none;
        }
        
        .navbar-brand:hover {
            color: var(--primary-dark) !important;
        }
        
        /* Button Styles */
        .btn {
            border-radius: var(--radius-md);
            font-weight: 500;
            padding: var(--spacing-sm) var(--spacing-lg);
            transition: all 0.2s ease;
            border: 1px solid transparent;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-outline-primary {
            background-color: transparent;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-lg {
            padding: var(--spacing-md) var(--spacing-xl);
            font-size: 1.1rem;
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            color: white;
            border-color: var(--danger-color);
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
            border-color: #dc2626;
            color: white;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-success {
            background-color: var(--success-color);
            color: white;
            border-color: var(--success-color);
        }
        
        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
            color: white;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        
        /* Card Styles */
        .card {
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all 0.2s ease;
            background-color: var(--bg-primary);
        }
        
        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: var(--primary-light);
        }
        
        .card-header {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            font-weight: 600;
            padding: var(--spacing-lg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
        }
        
        .card-header i {
            margin-right: var(--spacing-sm);
            font-size: 1.2em;
            opacity: 0.8;
        }
        
        .card-body {
            padding: var(--spacing-xl);
        }
        
        .card-footer {
            background-color: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
            padding: var(--spacing-lg);
        }
        
        /* Alert Styles */
        .alert {
            border-radius: var(--radius-md);
            border: 1px solid transparent;
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }
        
        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }
        
        .alert-warning {
            background-color: #fffbeb;
            border-color: #fed7aa;
            color: #92400e;
        }
        
        .alert-info {
            background-color: #eff6ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }
        
        /* Form Styles */
        .form-control {
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            padding: var(--spacing-sm) var(--spacing-md);
            transition: all 0.2s ease;
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: var(--spacing-xs);
        }
        
        .form-check-input {
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Table Styles */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }
        
        .table th {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            font-weight: 600;
            padding: var(--spacing-md);
            border-bottom: 1px solid var(--border-color);
        }
        
        .table td {
            padding: var(--spacing-md);
            border-bottom: 1px solid var(--border-color);
            background-color: var(--bg-primary);
        }
        
        .table-responsive {
            border-radius: var(--radius-md);
            overflow: hidden;
        }
        
        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            gap: var(--spacing-xs);
            margin: var(--spacing-lg) 0;
        }
        
        .page-link {
            padding: var(--spacing-sm) var(--spacing-md);
            color: var(--text-secondary);
            background-color: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            text-decoration: none;
        }
        
        .page-link:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .page-item.active .page-link {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .card-body {
                padding: var(--spacing-lg);
            }
            
            .card-header {
                padding: var(--spacing-md);
            }
            
            .btn {
                padding: var(--spacing-xs) var(--spacing-md);
                font-size: 0.9rem;
            }
            
            .container {
                padding: 0 var(--spacing-md);
            }
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
                    <h4 class="mb-4">Menu Utama</h4>
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
                            <a class="nav-link bg-danger text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                                    <a class="nav-link {{ request()->routeIs('informasi.sistem') ? 'active' : '' }}" href="{{ route('informasi.sistem') }}">
                                        <i class="fas fa-info-circle me-1"></i> Informasi Sistem
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
                                <li class="nav-item me-3">
                                    <a class="nav-link {{ request()->routeIs('informasi.sistem') ? 'active' : '' }}" href="{{ route('informasi.sistem') }}">
                                        <i class="fas fa-info-circle me-1"></i> Informasi Sistem
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