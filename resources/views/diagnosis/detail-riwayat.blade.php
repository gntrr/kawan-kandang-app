@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Detail Diagnosis</h4>
            <a href="{{ route('diagnosis.riwayat') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" width="200">Tanggal Diagnosis</th>
                            <td>{{ $riwayat->tanggal_diagnosis->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Kode Penyakit</th>
                            <td>{{ $riwayat->hasil_penyakit }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Penyakit</th>
                            <td>{{ $riwayat->penyakit->nama_penyakit ?? 'Tidak ditemukan' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="mb-4">
                <h5 class="mb-3">Gejala-gejala yang dipilih:</h5>
                <ul class="list-group">
                    @foreach($gejalas as $gejala)
                        <li class="list-group-item">
                            <strong>{{ $gejala->kode_gejala }}</strong> - {{ $gejala->nama_gejala }}
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="mb-4">
                <h5 class="mb-3">Solusi Penanganan:</h5>
                <div class="card">
                    <div class="card-body">
                        {!! nl2br(e($riwayat->solusi)) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('diagnosis.index') }}" class="btn btn-primary">
                <i class="fas fa-stethoscope me-2"></i> Diagnosis Baru
            </a>
        </div>
    </div>
</div>
@endsection 