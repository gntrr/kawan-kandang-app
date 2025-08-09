@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Riwayat Diagnosis</h4>
            <a href="{{ route('diagnosis.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-stethoscope me-1"></i> Diagnosis Baru
            </a>
        </div>
        <div class="card-body">
            @if($riwayats->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Kode Penyakit</th>
                                <th>Nama Penyakit</th>
                                <th width="15%">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayats as $index => $riwayat)
                                <tr>
                                    <td>{{ $riwayats->firstItem() + $index }}</td>
                                    <td>{{ $riwayat->tanggal_diagnosis->format('d/m/Y') }}</td>
                                    <td>{{ $riwayat->hasil_penyakit }}</td>
                                    <td>{{ $riwayat->penyakit->nama_penyakit ?? 'Tidak ditemukan' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('diagnosis.detail', $riwayat->id_diagnosis) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 pagination-container">
                    {{ $riwayats->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    Belum ada data riwayat diagnosis.
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.95rem;
        }
    }
    
    @media (max-width: 576px) {
        .table-responsive {
            font-size: 0.875rem;
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
            margin-top: 0.5rem;
            align-self: flex-end;
        }
        
        th, td {
            padding: 0.5rem !important;
        }
    }
</style>
@endsection 