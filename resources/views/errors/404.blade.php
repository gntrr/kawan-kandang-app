@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - 404')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="text-center">
                <!-- 404 Illustration -->
                <div class="error-illustration mb-4">
                    <svg width="300" height="200" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Background Circle -->
                        <circle cx="150" cy="100" r="80" fill="var(--gray-100)" stroke="var(--gray-200)" stroke-width="2"/>
                        
                        <!-- 404 Text -->
                        <text x="150" y="110" text-anchor="middle" font-family="Inter, sans-serif" font-size="36" font-weight="700" fill="var(--primary-color)">404</text>
                        
                        <!-- Sad Face -->
                        <circle cx="135" cy="85" r="3" fill="var(--gray-400)"/>
                        <circle cx="165" cy="85" r="3" fill="var(--gray-400)"/>
                        <path d="M135 125 Q150 135 165 125" stroke="var(--gray-400)" stroke-width="2" fill="none" stroke-linecap="round"/>
                        
                        <!-- Floating Elements -->
                        <circle cx="80" cy="60" r="4" fill="var(--primary-light)" opacity="0.6"/>
                        <circle cx="220" cy="70" r="3" fill="var(--accent-color)" opacity="0.7"/>
                        <circle cx="90" cy="140" r="2" fill="var(--success-color)" opacity="0.5"/>
                        <circle cx="210" cy="130" r="3" fill="var(--warning-color)" opacity="0.6"/>
                    </svg>
                </div>

                <!-- Error Message -->
                <div class="error-content">
                    <h1 class="error-title mb-3">Halaman Tidak Ditemukan</h1>
                    <p class="error-description mb-4">
                        Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin halaman tersebut telah dipindahkan, dihapus, atau URL yang Anda masukkan salah.
                    </p>
                    
                    <!-- Action Buttons -->
                    <div class="error-actions">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary me-3">
                            <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                        </a>
                        <a href="{{ route('diagnosis.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-stethoscope me-2"></i>Mulai Diagnosis
                        </a>
                    </div>
                    
                    <!-- Help Links -->
                    <div class="error-help mt-4">
                        <p class="text-muted mb-2">Atau Anda bisa:</p>
                        <div class="help-links">
                            <a href="{{ route('informasi.sistem') }}" class="help-link me-3">
                                <i class="fas fa-info-circle me-1"></i>Informasi Sistem
                            </a>
                            <a href="javascript:history.back()" class="help-link">
                                <i class="fas fa-arrow-left me-1"></i>Kembali ke Halaman Sebelumnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* 404 Error Page Styles */
.min-vh-100 {
    min-height: 100vh;
    margin-top: -2rem;
}

.error-illustration {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
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