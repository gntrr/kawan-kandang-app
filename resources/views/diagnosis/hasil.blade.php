@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Hasil Diagnosis</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    @if(isset($noPerfectMatch) && $noPerfectMatch)
                        {{-- Notifikasi tidak ada rule yang cocok sempurna --}}
                        <div class="alert alert-warning mb-4">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Tidak Ada Rule yang Cocok Sempurna</h5>
                                    <p class="mb-2">Sistem tidak dapat menemukan rule yang 100% sesuai dengan gejala yang Anda pilih.</p>
                                    <p class="mb-0">Silakan periksa kembali gejala yang dipilih atau konsultasikan dengan dokter hewan untuk diagnosis yang lebih akurat.</p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Tampilkan rule terdekat untuk referensi --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="fas fa-search me-2"></i>Rule Terdekat (Untuk Referensi)</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Catatan:</strong> Rule di bawah ini tidak cocok 100% dengan gejala yang dipilih, sehingga tidak dapat digunakan untuk diagnosis.
                                </div>
                                
                                @if(!empty($relevantRuleMatching))
                                    <div class="row">
                                        @foreach($relevantRuleMatching as $kode => $data)
                                            <div class="col-md-6 mb-3">
                                                <div class="rule-card border rounded-4 p-3 shadow-sm h-100" style="border-left: 5px solid #ff9500 !important; background-color: rgba(255, 149, 0, 0.05);">
                                                    <h6 class="border-bottom pb-2 d-flex justify-content-between align-items-center flex-wrap">
                                                        <span class="me-2">{{ $kode }}</span>
                                                        <span class="badge bg-warning text-dark">
                                                            {{ number_format($data['percentage'], 0) }}% cocok
                                                        </span>
                                                    </h6>
                                                    <div class="rule-content mt-2">
                                                        <p class="mb-2 small">
                                                            <strong><i class="fas fa-code-branch me-1"></i> IF:</strong> {{ $data['rule']->if_condition }} <br>
                                                            <strong><i class="fas fa-arrow-right me-1"></i> THEN:</strong> {{ $data['rule']->then_condition }}
                                                        </p>
                                                        
                                                        <div class="rule-match mt-3">
                                                            <div class="match-stats d-flex flex-wrap align-items-center">
                                                                <div class="me-2 mb-2">
                                                                    <span class="badge bg-light text-dark border">Gejala Cocok: {{ count($data['matched']) }}/{{ $data['totalGejala'] }}</span>
                                                                </div>
                                                                <div class="progress flex-grow-1 mt-1" style="height: 15px; background-color: rgba(0,0,0,0.05);">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $data['percentage'] }}%"></div>
                                                                </div>
                                                            </div>
                                                            @if(!empty($data['missing']))
                                                                <div class="missing-symptoms mt-2 p-2 rounded small" style="background-color: rgba(255, 0, 0, 0.05);">
                                                                    <strong class="text-danger">Gejala yang Hilang:</strong>
                                                                    <div class="mt-1">
                                                                        @foreach($data['missing'] as $missing)
                                                                            <span class="badge bg-danger me-1 mb-1">{{ $missing }}</span>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Saran untuk pengguna --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Saran</h5>
                            </div>
                            <div class="card-body">
                                <div class="suggestions">
                                    <div class="suggestion-item mb-3 p-3 rounded-3 border-start border-info border-4" style="background-color: rgba(13, 202, 240, 0.05);">
                                        <h6 class="text-info mb-2"><i class="fas fa-check-circle me-2"></i>Periksa Kembali Gejala</h6>
                                        <p class="mb-0 small">Pastikan semua gejala yang teramati sudah dipilih dengan benar. Mungkin ada gejala penting yang terlewat.</p>
                                    </div>
                                    <div class="suggestion-item mb-3 p-3 rounded-3 border-start border-warning border-4" style="background-color: rgba(255, 193, 7, 0.05);">
                                        <h6 class="text-warning mb-2"><i class="fas fa-user-md me-2"></i>Konsultasi dengan Dokter Hewan</h6>
                                        <p class="mb-0 small">Untuk diagnosis yang lebih akurat, disarankan untuk berkonsultasi langsung dengan dokter hewan.</p>
                                    </div>
                                    <div class="suggestion-item p-3 rounded-3 border-start border-success border-4" style="background-color: rgba(25, 135, 84, 0.05);">
                                        <h6 class="text-success mb-2"><i class="fas fa-redo me-2"></i>Coba Diagnosis Ulang</h6>
                                        <p class="mb-0 small">Amati kembali kondisi ayam dan coba melakukan diagnosis ulang dengan pemilihan gejala yang lebih teliti.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @elseif(isset($hasilPenyakit) && $hasilPenyakit)
                        {{-- Notifikasi diagnosis berhasil --}}
                        <div class="alert alert-success mb-4">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-check-circle fa-2x text-success"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Diagnosis Berhasil</h5>
                                    <p class="mb-0">Sistem menemukan rule yang 100% sesuai dengan gejala yang Anda pilih dan berhasil mendiagnosis penyakit.</p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Hasil diagnosis yang sudah ada --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="fas fa-virus me-2"></i>Penyakit Terdiagnosis</h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-7 col-sm-12 mb-3 mb-md-0">
                                        <h5 class="text-success mb-3">{{ $hasilPenyakit->nama_penyakit }} ({{ $hasilPenyakit->kode_penyakit }})</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="confidence-meter me-3">
                                                <div class="confidence-level" style="width: 100%; background: linear-gradient(to right, #36b4ff, #34c759);"></div>
                                            </div>
                                            <span class="confidence-text text-success">100% Confidence</span>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-5 col-sm-12 text-center">
                                        <div class="diagnosis-image mb-2">
                                            <i class="fas fa-viruses fa-5x text-success pulse-animation"></i>
                                        </div>
                                        <div class="badge bg-success p-2">
                                            {{ $bestMatch->kode_rule }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Rule matching section untuk diagnosis berhasil --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-exchange-alt me-2"></i>Rule Matching</h5>
                            </div>
                            <div class="card-body">
                                @if(!empty($relevantRuleMatching))
                                    <div class="row">
                                        @foreach($relevantRuleMatching as $kode => $data)
                                            <div class="col-md-6 mb-3">
                                                <div class="rule-card border rounded-4 p-3 shadow-sm h-100" style="border-left: 5px solid {{ $data['percentage'] == 100 ? '#34c759' : '#ff9500' }} !important; background-color: {{ $data['percentage'] == 100 ? 'rgba(52, 199, 89, 0.05)' : 'rgba(255, 149, 0, 0.05)' }};">
                                                    <h6 class="border-bottom pb-2 d-flex justify-content-between align-items-center flex-wrap">
                                                        <span class="me-2">{{ $kode }}</span>
                                                        <span class="badge bg-{{ $data['percentage'] == 100 ? 'success' : 'warning' }}">
                                                            {{ number_format($data['percentage'], 0) }}% cocok
                                                        </span>
                                                    </h6>
                                                    <div class="rule-content mt-2">
                                                        <p class="mb-2 small">
                                                            <strong><i class="fas fa-code-branch me-1"></i> IF:</strong> {{ $data['rule']->if_condition }} <br>
                                                            <strong><i class="fas fa-arrow-right me-1"></i> THEN:</strong> {{ $data['rule']->then_condition }}
                                                        </p>
                                                        
                                                        <div class="rule-match mt-3">
                                                            <div class="match-stats d-flex flex-wrap align-items-center">
                                                                <div class="me-2 mb-2">
                                                                    <span class="badge bg-light text-dark border">Gejala Cocok: {{ count($data['matched']) }}/{{ $data['totalGejala'] }}</span>
                                                                </div>
                                                                <div class="progress flex-grow-1 mt-1" style="height: 15px; background-color: rgba(0,0,0,0.05);">
                                                                    <div class="progress-bar bg-{{ $data['percentage'] == 100 ? 'success' : 'warning' }}" role="progressbar" style="width: {{ $data['percentage'] }}%"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Solusi penanganan --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="fas fa-medkit me-2"></i>Solusi Penanganan</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-3">{{ $hasilPenyakit->solusi }}</p>
                                
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">Segera konsultasikan dengan dokter hewan jika kondisi ayam tidak membaik.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    {{-- Gejala yang dipilih (selalu tampil) --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-list-ul me-2"></i>Gejala yang Dipilih</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($selectedGejalas as $gejala)
                                    <div class="col-md-6 col-sm-12 mb-2">
                                        <div class="selected-gejala p-2 rounded-3 border">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <strong>{{ $gejala->kode_gejala }}</strong> - {{ $gejala->nama_gejala }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Sidebar --}}
                <div class="col-lg-4 col-md-12">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Proses Diagnosis</h5>
                        </div>
                        <div class="card-body">
                            <div class="process-step p-3 mb-3 rounded bg-light">
                                <h6 class="text-secondary"><i class="fas fa-check-circle text-success me-2"></i>Input Gejala</h6>
                                <p class="mb-0 small">Anda telah memasukkan {{ count($selectedGejalas) }} gejala.</p>
                            </div>
                            
                            <div class="process-step p-3 mb-3 rounded bg-light">
                                <h6 class="text-secondary">
                                    @if(isset($noPerfectMatch) && $noPerfectMatch)
                                        <i class="fas fa-times-circle text-danger me-2"></i>Pencocokan Rule
                                    @else
                                        <i class="fas fa-check-circle text-success me-2"></i>Pencocokan Rule
                                    @endif
                                </h6>
                                <p class="mb-0 small">
                                    @if(isset($noPerfectMatch) && $noPerfectMatch)
                                        Tidak ada rule yang 100% cocok
                                    @elseif(isset($bestMatch) && $bestMatch)
                                        {{ $bestMatch->kode_rule }} (100% cocok)
                                    @else
                                        Tidak ada rule yang cocok
                                    @endif
                                </p>
                            </div>
                            
                            <div class="process-step p-3 mb-3 rounded bg-light">
                                <h6 class="text-secondary">
                                    @if(isset($noPerfectMatch) && $noPerfectMatch)
                                        <i class="fas fa-times-circle text-danger me-2"></i>Hasil Diagnosis
                                    @else
                                        <i class="fas fa-check-circle text-success me-2"></i>Hasil Diagnosis
                                    @endif
                                </h6>
                                <p class="mb-0 small">
                                    @if(isset($noPerfectMatch) && $noPerfectMatch)
                                        Diagnosis gagal - tidak ada rule yang sesuai
                                    @elseif(isset($hasilPenyakit) && $hasilPenyakit)
                                        {{ $hasilPenyakit->nama_penyakit }}
                                    @else
                                        Tidak ada penyakit yang terdeteksi
                                    @endif
                                </p>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('diagnosis.index') }}" class="btn btn-primary">
                                    <i class="fas fa-redo me-2"></i>Diagnosis Baru
                                </a>
                                @if(!isset($noPerfectMatch) || !$noPerfectMatch)
                                    <a href="{{ route('diagnosis.riwayat') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-history me-2"></i>Lihat Riwayat
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Existing styles --}}
<style>
    .confidence-meter {
        width: 70%;
        height: 20px;
        background-color: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .confidence-level {
        height: 100%;
        border-radius: 10px;
    }
    
    .confidence-text {
        font-weight: bold;
        color: #0091ff;
    }
    
    .selected-gejala {
        background-color: rgba(52, 199, 89, 0.1);
        border-color: rgba(52, 199, 89, 0.3) !important;
        transition: all 0.3s ease;
    }
    
    .selected-gejala:hover {
        transform: translateX(5px);
        background-color: rgba(52, 199, 89, 0.15);
    }
    
    .process-step {
        transition: all 0.3s ease;
        border-left: 4px solid #5856d6;
    }
    
    .process-step:hover {
        transform: translateX(5px);
        background-color: #f8f9fa !important;
    }
    
    .rule-card {
        transition: all 0.3s ease;
    }
    
    .rule-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }
    
    .suggestion-item {
        transition: all 0.3s ease;
    }
    
    .suggestion-item:hover {
        transform: translateX(5px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    
    .missing-symptoms {
        border-left: 3px solid #dc3545;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @media (max-width: 768px) {
        .confidence-meter {
            width: 60%;
        }
        
        .diagnosis-image {
            margin-top: 15px;
        }
        
        .process-step {
            padding: 10px !important;
        }
        
        .selected-gejala, .rule-content, .suggestion-item {
            font-size: 0.9rem;
        }
        
        .rule-card, .suggestion-item {
            padding: 0.75rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .confidence-meter {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .d-flex.align-items-center {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .diagnosis-image i {
            font-size: 3em !important;
        }
        
        .diagnosis-image {
            margin: 10px 0;
        }
        
        .badge {
            font-size: 0.7rem;
        }
        
        .card-header h5 {
            font-size: 1rem;
        }
        
        .rule-match .progress {
            height: 10px !important;
        }
        
        .match-stats {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .match-stats .progress {
            width: 100%;
        }
    }
</style>
@endsection
