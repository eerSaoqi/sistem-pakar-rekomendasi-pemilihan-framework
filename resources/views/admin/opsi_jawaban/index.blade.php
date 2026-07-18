@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Opsi Jawaban</h2>
    <a href="{{ route('admin.opsi_jawaban.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Baru
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4" width="80">ID</th>
                        <th>Kode Opsi</th>
                        <th>Pertanyaan Asosiasi</th>
                        <th>Isi Opsi Jawaban</th>
                        <th>Urutan</th>
                        <th class="text-center pe-4" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($opsiJawabans as $oj)
                    <tr>
                        <td class="ps-4">{{ $oj->id }}</td>
                        <td><span class="badge bg-secondary">{{ $oj->kode }}</span></td>
                        <td class="text-muted small">{{ $oj->pertanyaan->pertanyaan }} ({{ $oj->pertanyaan->kode }})</td>
                        <td class="fw-medium">{{ $oj->jawaban }}</td>
                        <td>{{ $oj->urutan }}</td>
                        <td class="text-center pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.opsi_jawaban.edit', $oj) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.opsi_jawaban.destroy', $oj) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus opsi jawaban ini?');">
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
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data opsi jawaban.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($opsiJawabans->hasPages())
    <div class="card-footer bg-white border-0 pt-4 pb-2">
        {{ $opsiJawabans->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
