@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Riwayat Konsultasi Pengguna</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4" width="80">ID</th>
                        <th>Tanggal</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Jenis Proyek</th>
                        <th class="text-center pe-4" width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($konsultasis as $k)
                    <tr>
                        <td class="ps-4">{{ $k->id }}</td>
                        <td>{{ $k->created_at->format('d M Y H:i') }}</td>
                        <td class="fw-bold">{{ $k->nama }}</td>
                        <td class="text-muted">{{ $k->email }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $k->jenisProyek->nama ?? '-' }}</span>
                        </td>
                        <td class="text-center pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.history.show', $k->id) }}" class="btn btn-outline-info" title="Detail Perhitungan">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <form action="{{ route('admin.history.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus riwayat konsultasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat konsultasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($konsultasis->hasPages())
    <div class="card-footer bg-white border-0 pt-4 pb-2">
        {{ $konsultasis->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
