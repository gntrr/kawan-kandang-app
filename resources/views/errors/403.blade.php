@extends('layouts.app')

@section('title', 'Akses Ditolak - 403')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="text-center">
                <!-- 403 Illustration -->
                <div class="error-illustration mb-4">
                    <svg width="300" height="200" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Background Circle -->
                        <circle cx="150" cy="100" r="80" fill="var(--gray-100)" stroke="var(--gray-200)" stroke-width="2"/>
                        
                        <!-- 403 Text -->
                        <text x="150" y="110" text-anchor="middle" font-family="Inter, sans-serif" font-size="36" font-weight="700" fill="var(--warning-color)">403</text>
                        
                        <!-- Lock Icon -->
                        <rect x="140" y="75" width="20" height="15" rx="2" fill="var(--warning-color)" stroke="var(--warning-color)" stroke-width="1"/>
                        <path d="M145 70 Q145 65 150 65 Q155 65 155 70 V75" stroke="var(--warning-color)" stroke-width="2" fill="none"/>
                        <circle cx="150" cy="82" r="2" fill="white"/>
                        <rect x="149" y="84" width="2" height="4" fill="white"/>
                        
                        <!-- Shield Icon -->
                        <path d="M150 55 L160 60 L160 70 Q160 75 150 80 Q140 75 140 70 L140 60 Z" fill="var(--error-color)" opacity="0.8"/>
                        <path d="M145 65 L148 68 L155 61" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        
                        <!-- Floating Elements -->
                        <circle cx="80" cy="60" r="4" fill="var(--warning-color)" opacity="0.6"/>
                        <circle cx="220" cy="70" r="3" fill="var(--error-color)" opacity="0.7"/>
                        <circle cx="90" cy="140" r="2" fill="var(--gray-400)" opacity="0.5"/>
                        <circle cx="210" cy="130" r="3" fill="var(--warning-color)" opacity="0.6"/>
                    </svg>
                </div>

                <!-- Error Message -->
                <div class="error-content">
                    <h1 class="error-title mb-3">Akses Ditolak</h1>
                    <p class="error-description mb-4">
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan login dengan akun yang memiliki hak akses yang sesuai.
                    </p>
                    
                    <!-- Action Buttons -->
                    <div class="error-actions">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary me-3">
                                <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary me-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                        @endauth
                        <a href="javascript:history.back()" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                    
                    <!-- Help Links -->
                    <div class="error-help mt-4">
                        <p class="text-muted mb-2">Butuh bantuan?</p>
                        <div class="help-links">
                            <a href="{{ route('informasi.sistem') }}" class="help-link me-3">
                                <i class="fas fa-info-circle me-1"></i>Informasi Sistem
                            </a>
                            @guest
                            <a href="{{ route('diagnosis.index') }}" class="help-link">
                                <i class="fas fa-stethoscope me-1"></i>Diagnosis Tanpa Login
                            </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* 403 Error Page Styles */
.min-vh-100 {
    min-height: 100vh;
    margin-top: -2rem;
}

.error-illustration {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.error-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.error-description {
    font-size: 1.1rem;
    color: var(--text-secondary);
    line-height: 1.6;
    max-width: 500px;
    margin: 0 auto;
}

.error-actions {
    margin: 2rem 0;
}

.btn {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    border-radius: var(--radius-md);
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    border: 1px solid transparent;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
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

.error-help {
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.help-links {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.help-link {
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s ease;
    display: inline-flex;
    align-items: center;
}

.help-link:hover {
    color: var(--primary-color);
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .error-title {
        font-size: 2rem;
    }
    
    .error-description {
        font-size: 1rem;
    }
    
    .error-actions {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .help-links {
        flex-direction: column;
        align-items: center;
    }
    
    .error-illustration svg {
        width: 250px;
        height: 167px;
    }
}

@media (max-width: 480px) {
    .error-title {
        font-size: 1.75rem;
    }
    
    .error-illustration svg {
        width: 200px;
        height: 133px;
    }
}
</style>
@endsection