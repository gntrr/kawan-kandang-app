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
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="info-card text-center p-4 rounded-4 shadow-sm" style="background: linear-gradient(120deg, #e6f6ff, #d9f1ff);">
                        <div class="info-icon mb-3 mx-auto">
                            <i class="fas fa-database fa-3x" style="color: #0091ff;"></i>
                        </div>
                        <h5 class="fw-bold">Basis Pengetahuan</h5>
                        <p class="mb-0">Sistem dilengkapi dengan database gejala dan penyakit ayam yang komprehensif.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="info-card text-center p-4 rounded-4 shadow-sm" style="background: linear-gradient(120deg, #e0faeb, #d7f9e9);">
                        <div class="info-icon mb-3 mx-auto">
                            <i class="fas fa-brain fa-3x" style="color: #34c759;"></i>
                        </div>
                        <h5 class="fw-bold">Forward Chaining</h5>
                        <p class="mb-0">Menggunakan metode inferensi untuk mendiagnosis penyakit berdasarkan gejala.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="info-card text-center p-4 rounded-4 shadow-sm" style="background: linear-gradient(120deg, #fff8e6, #fff5d6);">
                        <div class="info-icon mb-3 mx-auto">
                            <i class="fas fa-heartbeat fa-3x" style="color: #ff9500;"></i>
                        </div>
                        <h5 class="fw-bold">Solusi Penanganan</h5>
                        <p class="mb-0">Memberikan rekomendasi penanganan untuk setiap penyakit yang terdiagnosis.</p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0" style="background: linear-gradient(120deg, #f8f9fa, #e9ecef);">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-cogs me-2"></i>Cara Kerja Sistem</h5>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="text-center">
                                        <div class="step-icon mb-2">
                                            <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                                        </div>
                                        <h6 class="fw-bold">1. Input Gejala</h6>
                                        <p class="small mb-0">Pilih gejala yang diamati pada ayam</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="text-center">
                                        <div class="step-icon mb-2">
                                            <i class="fas fa-search fa-2x text-success"></i>
                                        </div>
                                        <h6 class="fw-bold">2. Analisis</h6>
                                        <p class="small mb-0">Sistem menganalisis dengan forward chaining</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="text-center">
                                        <div class="step-icon mb-2">
                                            <i class="fas fa-diagnoses fa-2x text-warning"></i>
                                        </div>
                                        <h6 class="fw-bold">3. Diagnosis</h6>
                                        <p class="small mb-0">Mendapatkan hasil diagnosis penyakit</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="text-center">
                                        <div class="step-icon mb-2">
                                            <i class="fas fa-prescription-bottle-alt fa-2x text-info"></i>
                                        </div>
                                        <h6 class="fw-bold">4. Solusi</h6>
                                        <p class="small mb-0">Rekomendasi penanganan dan pengobatan</p>
                                    </div>
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
    .info-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .info-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .info-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255,255,255,0.8);
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.07);
    }
    
    .step-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255,255,255,0.9);
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    @media (max-width: 576px) {
        .info-icon {
            width: 60px;
            height: 60px;
        }
        
        .info-icon i {
            font-size: 2em !important;
        }
        
        .info-card {
            padding: 15px !important;
        }
        
        .step-icon {
            width: 50px;
            height: 50px;
        }
        
        .step-icon i {
            font-size: 1.5em !important;
        }
        
        .btn-lg {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
    }
</style>
@endsection