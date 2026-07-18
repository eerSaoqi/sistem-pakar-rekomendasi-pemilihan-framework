@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Knowledge Base (Aturan CF)</h2>
    <a href="{{ route('admin.knowledge_base.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Entri Baru
    </a>
</div>

<!-- Filter Box -->
<div class="card shadow-sm border-0 mb-4 bg-light">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.knowledge_base.index') }}" class="row g-3 align-items-center">
            <div class="col-md-4">
                <label for="filter_fw" class="visually-hidden">Framework</label>
                <select name="framework_id" id="filter_fw" class="form-select">
                    <option value="">-- Semua Framework --</option>
                    @foreach($frameworks as $fw)
                        <option value="{{ $fw->id }}" {{ request('framework_id') == $fw->id ? 'selected' : '' }}>
                            {{ $fw->nama_framework }} ({{ $fw->kode }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100"><i class="bi bi-funnel"></i> Filter</button>
            </div>
            @if(request()->filled('framework_id'))
                <div class="col-md-2">
                    <a href="{{ route('admin.knowledge_base.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            @endif
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4" width="80">ID</th>
                        <th>Framework</th>
                        <th>Kriteria Pertanyaan</th>
                        <th>Pilihan Jawaban</th>
                        <th>CF Pakar</th>
                        <th class="text-center pe-4" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kbs as $kb)
                    <tr>
                        <td class="ps-4">{{ $kb->id }}</td>
                        <td>
                            <span class="badge bg-secondary me-1">{{ $kb->framework->kode }}</span>
                            <span class="fw-bold">{{ $kb->framework->nama_framework }}</span>
                        </td>
                        <td class="text-wrap" style="max-width: 300px;">
                            <span class="badge bg-dark text-white me-1">{{ $kb->pertanyaan->kode }}</span>
                            {{ $kb->pertanyaan->pertanyaan }}
                        </td>
                        <td>
                            <span class="badge bg-info text-dark me-1">{{ $kb->opsiJawaban->kode }}</span>
                            {{ $kb->opsiJawaban->jawaban }}
                        </td>
                        <td class="fw-bold text-primary">{{ number_format($kb->cf_pakar, 2) }}</td>
                        <td class="text-center pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.knowledge_base.edit', $kb) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.knowledge_base.destroy', $kb) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus entri ini dari Knowledge Base?');">
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
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data aturan di Knowledge Base.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($kbs->hasPages())
    <div class="card-footer bg-white border-0 pt-4 pb-2">
        {{ $kbs->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
