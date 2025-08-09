@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Penyakit</h4>
            <a href="{{ route('penyakit.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" width="200">Kode Penyakit</th>
                            <td>{{ $penyakit->kode_penyakit }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Penyakit</th>
                            <td>{{ $penyakit->nama_penyakit }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="mb-4">
                <h5 class="mb-3">Solusi Penanganan:</h5>
                <div class="card">
                    <div class="card-body">
                        {!! nl2br(e($penyakit->solusi)) !!}
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('penyakit.edit', $penyakit->id_penyakit) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <form action="{{ route('penyakit.destroy', $penyakit->id_penyakit) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus penyakit ini?')">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 