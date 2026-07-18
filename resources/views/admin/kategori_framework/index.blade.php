@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Kategori Framework</h2>
    <a href="{{ route('admin.kategori_framework.create') }}" class="btn btn-primary">
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
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-center pe-4" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                    <tr>
                        <td class="ps-4">{{ $kategori->id }}</td>
                        <td><span class="badge bg-secondary">{{ $kategori->kode }}</span></td>
                        <td class="fw-medium">{{ $kategori->nama }}</td>
                        <td class="text-muted text-truncate" style="max-width: 300px;">{{ $kategori->deskripsi }}</td>
                        <td class="text-center pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.kategori_framework.edit', $kategori) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.kategori_framework.destroy', $kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data kategori framework.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($kategoris->hasPages())
    <div class="card-footer bg-white border-0 pt-4 pb-2">
        {{ $kategoris->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
