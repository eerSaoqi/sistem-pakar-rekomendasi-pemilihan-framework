@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Pertanyaan</h2>
    <a href="{{ route('admin.pertanyaan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Baru
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4" width="80">Urutan</th>
                        <th>Kode</th>
                        <th>Pertanyaan</th>
                        <th>Kategori Framework</th>
                        <th>Status</th>
                        <th class="text-center pe-4" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pertanyaans as $p)
                    <tr>
                        <td class="ps-4 text-center fw-medium">{{ $p->urutan }}</td>
                        <td><span class="badge bg-secondary">{{ $p->kode }}</span></td>
                        <td class="fw-medium text-wrap" style="max-width: 400px;">{{ $p->pertanyaan }}</td>
                        <td>
                            @forelse($p->kategoriFrameworks as $kat)
                                <span class="badge bg-info text-dark me-1">{{ $kat->nama }}</span>
                            @empty
                                <span class="text-muted small">Semua Kategori (Global/JP01)</span>
                            @endforelse
                        </td>
                        <td>
                            @if($p->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.pertanyaan.edit', $p) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.pertanyaan.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pertanyaan ini?');">
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
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data pertanyaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pertanyaans->hasPages())
    <div class="card-footer bg-white border-0 pt-4 pb-2">
        {{ $pertanyaans->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
