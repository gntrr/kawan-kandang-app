@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0"><i class="fas fa-question-circle me-2"></i>Informasi Sistem</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-4">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading">Tentang KawanKandang</h5>
                        <p class="mb-0">Sistem Pendukung Keputusan untuk deteksi dini penyakit pada ayam broiler menggunakan algoritma forward chaining.</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <div class="icon-wrapper">
                                <i class="fas fa-database"></i>
                            </div>
                        </div>
                        <h5 class="feature-title">Basis Pengetahuan</h5>
                        <p class="feature-description">Sistem dilengkapi dengan database gejala dan penyakit ayam yang komprehensif.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <div class="icon-wrapper success">
                                <i class="fas fa-brain"></i>
                            </div>
                        </div>
                        <h5 class="feature-title">Forward Chaining</h5>
                        <p class="feature-description">Menggunakan metode inferensi untuk mendiagnosis penyakit berdasarkan gejala.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <div class="icon-wrapper warning">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                        </div>
                        <h5 class="feature-title">Solusi Penanganan</h5>
                        <p class="feature-description">Memberikan rekomendasi penanganan untuk setiap penyakit yang terdiagnosis.</p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12">
                    <div class="workflow-section">
                        <div class="section-header text-center mb-4">
                            <h5 class="section-title"><i class="fas fa-cogs me-2"></i>Cara Kerja Sistem</h5>
                            <p class="section-subtitle">Proses diagnosis yang mudah dan akurat dalam 4 langkah</p>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="workflow-step text-center">
                                    <div class="step-number">1</div>
                                    <div class="step-icon-modern mb-3">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <h6 class="step-title">Input Gejala</h6>
                                    <p class="step-description">Pilih gejala yang diamati pada ayam</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="workflow-step text-center">
                                    <div class="step-number">2</div>
                                    <div class="step-icon-modern mb-3">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h6 class="step-title">Analisis</h6>
                                    <p class="step-description">Sistem menganalisis dengan forward chaining</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="workflow-step text-center">
                                    <div class="step-number">3</div>
                                    <div class="step-icon-modern mb-3">
                                        <i class="fas fa-diagnoses"></i>
                                    </div>
                                    <h6 class="step-title">Diagnosis</h6>
                                    <p class="step-description">Mendapatkan hasil diagnosis penyakit</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="workflow-step text-center">
                                    <div class="step-number">4</div>
                                    <div class="step-icon-modern mb-3">
                                        <i class="fas fa-prescription-bottle-alt"></i>
                                    </div>
                                    <h6 class="step-title">Solusi</h6>
                                    <p class="step-description">Rekomendasi penanganan dan pengobatan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('diagnosis.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-stethoscope me-2"></i>Mulai Diagnosis
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modern Minimalist Information System Styles */
    .feature-card {
        background-color: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        transition: all 0.2s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        transform: scaleX(0);
        transition: transform 0.2s ease;
    }
    
    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }
    
    .feature-card:hover::before {
        transform: scaleX(1);
    }
    
    .icon-wrapper {
        width: 64px;
        height: 64px;
        border-radius: var(--radius-full);
        background-color: rgba(59, 130, 246, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        transition: all 0.2s ease;
    }
    
    .icon-wrapper.success {
        background-color: rgba(16, 185, 129, 0.1);
    }
    
    .icon-wrapper.warning {
        background-color: rgba(245, 158, 11, 0.1);
    }
    
    .icon-wrapper i {
        font-size: 1.5rem;
        color: var(--primary-color);
    }
    
    .icon-wrapper.success i {
        color: var(--success-color);
    }
    
    .icon-wrapper.warning i {
        color: var(--warning-color);
    }
    
    .feature-card:hover .icon-wrapper {
        transform: scale(1.1);
    }
    
    .feature-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: var(--spacing-sm);
        font-size: 1.1rem;
    }
    
    .feature-description {
        color: var(--text-secondary);
        line-height: 1.5;
        margin-bottom: 0;
        font-size: 0.95rem;
    }
    
    /* Workflow Section */
    .workflow-section {
        background-color: var(--bg-secondary);
        border-radius: var(--radius-xl);
        padding: var(--spacing-xl);
        border: 1px solid var(--border-color);
    }
    
    .section-title {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 1.5rem;
        margin-bottom: var(--spacing-xs);
    }
    
    .section-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-bottom: 0;
    }
    
    .workflow-step {
        position: relative;
        padding: var(--spacing-lg);
    }
    
    .step-number {
        position: absolute;
        top: -10px;
        right: 20px;
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
        box-shadow: var(--shadow-sm);
    }
    
    .step-icon-modern {
        width: 56px;
        height: 56px;
        background-color: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        transition: all 0.2s ease;
    }
    
    .step-icon-modern i {
        font-size: 1.25rem;
        color: var(--primary-color);
    }
    
    .workflow-step:hover .step-icon-modern {
        border-color: var(--primary-color);
        background-color: rgba(59, 130, 246, 0.05);
        transform: scale(1.05);
    }
    
    .step-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: var(--spacing-xs);
        font-size: 1rem;
    }
    
    .step-description {
        color: var(--text-secondary);
        font-size: 0.875rem;
        line-height: 1.4;
        margin-bottom: 0;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .workflow-section {
            padding: var(--spacing-lg);
        }
        
        .icon-wrapper {
            width: 48px;
            height: 48px;
        }
        
        .icon-wrapper i {
            font-size: 1.25rem;
        }
        
        .step-icon-modern {
            width: 48px;
            height: 48px;
        }
        
        .step-icon-modern i {
            font-size: 1rem;
        }
        
        .step-number {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
        }
    }
</style>
@endsection