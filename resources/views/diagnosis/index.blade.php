@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="mb-0"><i class="fas fa-stethoscope me-2"></i>Diagnosis Penyakit Ayam Broiler</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-4">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading">Petunjuk Diagnosis</h5>
                        <p class="mb-0">Silakan pilih gejala-gejala yang teramati pada ayam untuk mendapatkan diagnosis penyakit yang akurat.</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('diagnosis.proses') }}" method="POST">
                @csrf
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <h5 class="border-bottom pb-2 mb-3 text-primary fw-bold">
                    <div class="d-flex align-items-center">
                        <span class="section-badge me-2"><i class="fas fa-list"></i></span>
                        Daftar Gejala
                    </div>
                </h5>
                
                <div class="row">
                    @foreach($gejalas as $gejala)
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="gejala-card p-4 rounded border" onclick="toggleCheckbox('gejala_{{ $gejala->id_gejala }}')">
                                <input class="form-check-input visually-hidden" type="checkbox" value="{{ $gejala->id_gejala }}" 
                                    id="gejala_{{ $gejala->id_gejala }}" name="gejala_ids[]">
                                <div class="d-flex align-items-start">
                                    <div class="symptom-icon me-3">
                                        <i class="fas fa-square-o check-icon"></i>
                                        <i class="fas fa-check-square check-icon-checked"></i>
                                    </div>
                                    <div>
                                        <span class="symptom-code">{{ $gejala->kode_gejala }}</span>
                                        <div class="symptom-name">{{ $gejala->nama_gejala }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <script>
                    function toggleCheckbox(id) {
                        const checkbox = document.getElementById(id);
                        checkbox.checked = !checkbox.checked;
                        
                        // Trigger change event for any listeners
                        const event = new Event('change');
                        checkbox.dispatchEvent(event);
                    }
                </script>

                <style>
                    .check-icon-checked {
                        display: none;
                        color: var(--primary-color);
                    }

                    .gejala-card:has(.form-check-input:checked) .check-icon {
                        display: none;
                    }

                    .gejala-card:has(.form-check-input:checked) .check-icon-checked {
                        display: inline-block;
                    }
                </style>
                
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-stethoscope me-2"></i> Proses Diagnosis
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card shadow mt-4">
        <div class="card-body text-center">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="mb-2"><i class="fas fa-question-circle me-2"></i>Butuh informasi lebih lanjut tentang sistem?</h5>
                    <p class="text-muted mb-0">Pelajari cara kerja sistem diagnosis dan teknologi yang digunakan.</p>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('informasi.sistem') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Informasi Sistem
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Clean Minimalist Diagnosis Styles */
    .gejala-card {
        background-color: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        transition: all 0.15s ease;
        cursor: pointer;
        position: relative;
    }
    
    .gejala-card:hover {
        border-color: var(--primary-color);
        background-color: var(--bg-secondary);
    }
    
    .gejala-card:has(.form-check-input:checked) {
        background-color: rgba(59, 130, 246, 0.03);
        border-color: var(--primary-color);
        border-width: 2px;
    }
    
    .symptom-icon {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-top: 2px;
    }
    
    .gejala-card:has(.form-check-input:checked) .symptom-icon {
        color: var(--primary-color);
    }
    
    .symptom-code {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 0.875rem;
        letter-spacing: 0.5px;
    }
    
    .symptom-name {
        color: var(--text-primary);
        font-size: 0.95rem;
        line-height: 1.4;
        margin-top: 2px;
    }
    
    .gejala-card:has(.form-check-input:checked) .symptom-name {
        font-weight: 500;
    }
    
    /* Clean checkbox styling */
    .form-check-input {
        width: 1.125rem;
        height: 1.125rem;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        background-color: var(--bg-primary);
        margin-top: 0.125rem;
    }
    
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' d='m6 10 3 3 6-6'/%3e%3c/svg%3e");
    }
    
    .form-check-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.08);
        outline: none;
    }
    
    .form-check-input:hover:not(:checked) {
        border-color: var(--primary-light);
    }
    
    /* Section badge styling */
    .section-badge {
        background-color: var(--primary-color);
        color: white;
        border-radius: var(--radius-sm);
        padding: 0.375rem 0.5rem;
        font-weight: 500;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .gejala-card {
            padding: 1rem !important;
        }
        
        .symptom-icon {
            display: none;
        }
        
        .form-check-label {
            margin-left: 0.5rem !important;
        }
    }
</style>
@endsection