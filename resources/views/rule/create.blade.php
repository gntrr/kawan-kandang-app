@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Rule</h4>
            <a href="{{ route('rule.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('rule.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="kode_rule" class="form-label">Kode Rule</label>
                    <input type="text" class="form-control @error('kode_rule') is-invalid @enderror" id="kode_rule" name="kode_rule" value="{{ old('kode_rule') }}" placeholder="contoh: R002" required>
                    @error('kode_rule')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="nama_rule" class="form-label">Nama Rule</label>
                    <input type="text" class="form-control @error('nama_rule') is-invalid @enderror" id="nama_rule" name="nama_rule" value="{{ old('nama_rule') }}">
                    @error('nama_rule')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Gejala (IF)</label>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($gejalas as $gejala)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $gejala->id_gejala }}" id="gejala_{{ $gejala->id_gejala }}" name="gejala_ids[]" {{ in_array($gejala->id_gejala, old('gejala_ids', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gejala_{{ $gejala->id_gejala }}">
                                                <strong>{{ $gejala->kode_gejala }}</strong> - {{ $gejala->nama_gejala }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('gejala_ids')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="then_condition" class="form-label">Penyakit (THEN)</label>
                    <select class="form-select @error('then_condition') is-invalid @enderror" id="then_condition" name="then_condition" required>
                        <option value="">-- Pilih Penyakit --</option>
                        @foreach($penyakits as $penyakit)
                            <option value="{{ $penyakit->kode_penyakit }}" {{ old('then_condition') == $penyakit->kode_penyakit ? 'selected' : '' }}>
                                {{ $penyakit->kode_penyakit }} - {{ $penyakit->nama_penyakit }}
                            </option>
                        @endforeach
                    </select>
                    @error('then_condition')
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