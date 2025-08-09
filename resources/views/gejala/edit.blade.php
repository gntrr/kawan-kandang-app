@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Gejala</h4>
            <a href="{{ route('gejala.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('gejala.update', $gejala->id_gejala) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="kode_gejala" class="form-label">Kode Gejala</label>
                    <input type="text" class="form-control @error('kode_gejala') is-invalid @enderror" id="kode_gejala" name="kode_gejala" value="{{ old('kode_gejala', $gejala->kode_gejala) }}" required>
                    @error('kode_gejala')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="nama_gejala" class="form-label">Nama Gejala</label>
                    <input type="text" class="form-control @error('nama_gejala') is-invalid @enderror" id="nama_gejala" name="nama_gejala" value="{{ old('nama_gejala', $gejala->nama_gejala) }}" required>
                    @error('nama_gejala')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 