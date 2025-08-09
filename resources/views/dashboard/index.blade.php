@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-primary shadow h-100">
                <div class="card-body text-center">
                    <h1 class="display-4 text-primary mb-0">{{ $totalGejala }}</h1>
                    <p class="mt-2">Total Gejala</p>
                </div>
                <div class="card-footer bg-primary">
                    <a href="{{ route('gejala.index') }}" class="text-white text-decoration-none d-block text-center">
                        <i class="fas fa-list me-1"></i> Lihat Semua
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card border-success shadow h-100">
                <div class="card-body text-center">
                    <h1 class="display-4 text-success mb-0">{{ $totalPenyakit }}</h1>
                    <p class="mt-2">Total Penyakit</p>
                </div>
                <div class="card-footer bg-success">
                    <a href="{{ route('penyakit.index') }}" class="text-white text-decoration-none d-block text-center">
                        <i class="fas fa-bug me-1"></i> Lihat Semua
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card border-info shadow h-100">
                <div class="card-body text-center">
                    <h1 class="display-4 text-info mb-0">{{ $totalRule }}</h1>
                    <p class="mt-2">Total Rule</p>
                </div>
                <div class="card-footer bg-info">
                    <a href="{{ route('rule.index') }}" class="text-white text-decoration-none d-block text-center">
                        <i class="fas fa-cogs me-1"></i> Lihat Semua
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card border-warning shadow h-100">
                <div class="card-body text-center">
                    <h1 class="display-4 text-warning mb-0">{{ $totalDiagnosis }}</h1>
                    <p class="mt-2">Total Diagnosis</p>
                </div>
                <div class="card-footer bg-warning">
                    <a href="{{ route('diagnosis.riwayat') }}" class="text-white text-decoration-none d-block text-center">
                        <i class="fas fa-history me-1"></i> Lihat Semua
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-dark">
                    <h5 class="mb-0 text-white">Riwayat Diagnosis Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentDiagnoses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kode Penyakit</th>
                                        <th>Nama Penyakit</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentDiagnoses as $diagnosis)
                                        <tr>
                                            <td>{{ $diagnosis->tanggal_diagnosis->format('d/m/Y') }}</td>
                                            <td>{{ $diagnosis->hasil_penyakit }}</td>
                                            <td>{{ $diagnosis->penyakit->nama_penyakit ?? 'Tidak ditemukan' }}</td>
                                            <td>
                                                <a href="{{ route('diagnosis.detail', $diagnosis->id_diagnosis) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Belum ada data diagnosis.
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('diagnosis.index') }}" class="btn btn-primary">
                        <i class="fas fa-stethoscope me-1"></i> Diagnosa Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 