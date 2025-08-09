@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Manajemen Rule</h4>
            <a href="{{ route('rule.create') }}" class="btn btn-sm btn-light">
                <i class="fas fa-plus me-1"></i> Tambah Rule
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if($rules->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Kode</th>
                                <th width="20%">Nama Rule</th>
                                <th>IF (Gejala)</th>
                                <th width="15%">THEN (Penyakit)</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rules as $index => $rule)
                                <tr>
                                    <td>{{ $rules->firstItem() + $index }}</td>
                                    <td>{{ $rule->kode_rule }}</td>
                                    <td>{{ $rule->nama_rule }}</td>
                                    <td class="if-condition">{{ $rule->if_condition }}</td>
                                    <td>{{ $rule->then_condition }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <a href="{{ route('rule.edit', $rule->id_rule) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('rule.destroy', $rule->id_rule) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rule ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 pagination-container">
                    {{ $rules->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    Belum ada data rule.
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @media (max-width: 992px) {
        .if-condition {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    }
    
    @media (max-width: 768px) {
        .if-condition {
            max-width: 150px;
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
        
        .d-flex.flex-wrap.gap-1 {
            justify-content: center;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .card-header .btn {
            margin-top: 0.5rem;
            align-self: flex-end;
        }
        
        .if-condition {
            max-width: 100px;
        }
    }
</style>
@endsection 