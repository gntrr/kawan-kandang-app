@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Penyakit</h4>
            <a href="{{ route('penyakit.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('penyakit.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="kode_penyakit" class="form-label">Kode Penyakit</label>
                    <input type="text" class="form-control @error('kode_penyakit') is-invalid @enderror" id="kode_penyakit" name="kode_penyakit" value="{{ old('kode_penyakit') }}" placeholder="contoh: P002" required>
                    @error('kode_penyakit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                    <input type="text" class="form-control @error('nama_penyakit') is-invalid @enderror" id="nama_penyakit" name="nama_penyakit" value="{{ old('nama_penyakit') }}" required>
                    @error('nama_penyakit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="solusi" class="form-label">Solusi Penanganan</label>
                    <textarea class="form-control @error('solusi') is-invalid @enderror" id="solusi" name="solusi" rows="5">{{ old('solusi') }}</textarea>
                    @error('solusi')
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