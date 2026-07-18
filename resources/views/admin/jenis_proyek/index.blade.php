@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Jenis Proyek</h2>
    <a href="{{ route('admin.jenis_proyek.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Baru
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Kode</th>
                        <th>Nama Proyek</th>
                        <th>Kategori Aktif</th>
                        <th class="text-center pe-4" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisProyeks as $jp)
                    <tr>
                        <td class="ps-4">{{ $jp->id }}</td>
                        <td><span class="badge bg-secondary">{{ $jp->kode }}</span></td>
                        <td class="fw-medium">{{ $jp->nama }}</td>
                        <td>
                            @foreach($jp->kategoriFrameworks as $kat)
                                <span class="badge bg-info text-dark me-1">{{ $kat->nama }}</span>
                            @endforeach
                        </td>
                        <td class="text-center pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.jenis_proyek.edit', $jp) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.jenis_proyek.destroy', $jp) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jenis proyek ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data jenis proyek.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($jenisProyeks->hasPages())
    <div class="card-footer bg-white border-0 pt-4 pb-2">
        {{ $jenisProyeks->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
