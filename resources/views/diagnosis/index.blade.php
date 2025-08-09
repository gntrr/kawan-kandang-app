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
                        <span class="badge bg-primary me-2 animate-pulse"><i class="fas fa-list"></i></span>
                        Daftar Gejala
                    </div>
                </h5>
                
                <div class="row">
                    @foreach($gejalas as $gejala)
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="gejala-card form-check custom-checkbox p-3 rounded-3 border shadow-sm" 
                                style="border-left: 5px solid {{ $loop->iteration % 6 == 0 ? '#ff375f' : ($loop->iteration % 6 == 1 ? '#0091ff' : ($loop->iteration % 6 == 2 ? '#34c759' : ($loop->iteration % 6 == 3 ? '#ff9500' : ($loop->iteration % 6 == 4 ? '#5856d6' : '#5ac8fa')))) }} !important;">
                                <input class="form-check-input" type="checkbox" value="{{ $gejala->id_gejala }}" 
                                    id="gejala_{{ $gejala->id_gejala }}" name="gejala_ids[]">
                                <label class="form-check-label w-100 ms-2" for="gejala_{{ $gejala->id_gejala }}">
                                    <strong class="text-dark">{{ $gejala->kode_gejala }}</strong> - {{ $gejala->nama_gejala }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                
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
    .form-check-input:checked + .form-check-label {
        font-weight: bold;
    }
    
    .gejala-card {
        background-color: white;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .gejala-card:hover {
        transform: translateX(5px) translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
    }
    
    .gejala-card .form-check-input:checked ~ label {
        font-weight: bold;
    }
    
    .gejala-card:has(.form-check-input:checked) {
        background-color: rgba(0,145,255,0.05);
        border-color: var(--primary-color);
    }
    

    
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .animate-pulse {
        animation: pulse 2s infinite;
    }

    @media (max-width: 576px) {
        .gejala-card {
            padding: 10px !important;
        }
        
        .btn-lg {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
    }
</style>
@endsection