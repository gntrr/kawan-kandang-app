@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Rule</h4>
            <a href="{{ route('rule.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Kode Rule</div>
                <div class="col-md-9">{{ $rule->kode_rule }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Nama Rule</div>
                <div class="col-md-9">{{ $rule->nama_rule }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">IF Condition</div>
                <div class="col-md-9">{{ $rule->if_condition }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">THEN Condition</div>
                <div class="col-md-9">{{ $rule->then_condition }} ({{ $rule->penyakit->nama_penyakit ?? 'Unknown' }})</div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('rule.edit', $rule->id_rule) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <form action="{{ route('rule.destroy', $rule->id_rule) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rule ini?')">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
