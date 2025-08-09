@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Gejala</h4>
            <a href="{{ route('gejala.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('gejala.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="kode_gejala" class="form-label">Kode Gejala</label>
                    <input type="text" class="form-control @error('kode_gejala') is-invalid @enderror" id="kode_gejala" name="kode_gejala" value="{{ old('kode_gejala') }}" placeholder="contoh: G013" required>
                    @error('kode_gejala')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="nama_gejala" class="form-label">Nama Gejala</label>
                    <input type="text" class="form-control @error('nama_gejala') is-invalid @enderror" id="nama_gejala" name="nama_gejala" value="{{ old('nama_gejala') }}" required>
                    @error('nama_gejala')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 