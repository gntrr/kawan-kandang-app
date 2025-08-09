@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Manajemen Penyakit</h4>
            <a href="{{ route('penyakit.create') }}" class="btn btn-sm btn-light">
                <i class="fas fa-plus me-1"></i> Tambah Penyakit
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if($penyakits->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Kode</th>
                                <th>Nama Penyakit</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penyakits as $index => $penyakit)
                                <tr>
                                    <td>{{ $penyakits->firstItem() + $index }}</td>
                                    <td>{{ $penyakit->kode_penyakit }}</td>
                                    <td>{{ $penyakit->nama_penyakit }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <a href="{{ route('penyakit.show', $penyakit->id_penyakit) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="{{ route('penyakit.edit', $penyakit->id_penyakit) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('penyakit.destroy', $penyakit->id_penyakit) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus penyakit ini?')">
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
                    {{ $penyakits->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    Belum ada data penyakit.
                </div>
            @endif
        </div>
    </div>
</div>

<style>
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
    }
</style>
@endsection 