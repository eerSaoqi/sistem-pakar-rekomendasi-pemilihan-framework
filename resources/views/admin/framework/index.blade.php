@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Framework</h2>
    <a href="{{ route('admin.framework.create') }}" class="btn btn-primary">
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
                        <th>Kategori</th>
                        <th>Nama Framework</th>
                        <th>Bahasa</th>
                        <th>Website</th>
                        <th class="text-center pe-4" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($frameworks as $fw)
                    <tr>
                        <td class="ps-4">{{ $fw->id }}</td>
                        <td><span class="badge bg-secondary">{{ $fw->kode }}</span></td>
                        <td><span class="badge bg-info text-dark">{{ $fw->kategoriFramework->nama }}</span></td>
                        <td class="fw-medium">{{ $fw->nama_framework }}</td>
                        <td>{{ $fw->bahasa }}</td>
                        <td>
                            @if($fw->website)
                                <a href="{{ $fw->website }}" target="_blank" class="small text-decoration-none">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>Kunjungi
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="text-center pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.framework.edit', $fw) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.framework.destroy', $fw) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus framework ini?');">
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
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data framework.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($frameworks->hasPages())
    <div class="card-footer bg-white border-0 pt-4 pb-2">
        {{ $frameworks->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
