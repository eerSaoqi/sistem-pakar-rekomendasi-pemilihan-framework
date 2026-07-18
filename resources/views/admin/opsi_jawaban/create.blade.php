@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Tambah Opsi Jawaban</h2>
            <a href="{{ route('admin.opsi_jawaban.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.opsi_jawaban.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="pertanyaan_id" class="form-label fw-bold">Pertanyaan Asosiasi</label>
                        <select class="form-select @error('pertanyaan_id') is-invalid @enderror" id="pertanyaan_id" name="pertanyaan_id" required>
                            <option value="">-- Pilih Pertanyaan --</option>
                            @foreach($pertanyaans as $p)
                                <option value="{{ $p->id }}" {{ old('pertanyaan_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->pertanyaan }} ({{ $p->kode }})
                                </option>
                            @endforeach
                        </select>
                        @error('pertanyaan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kode" class="form-label fw-bold">Kode Opsi</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode') }}" required placeholder="Contoh: OP011">
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jawaban" class="form-label fw-bold">Isi Opsi Jawaban</label>
                        <input type="text" class="form-control @error('jawaban') is-invalid @enderror" id="jawaban" name="jawaban" value="{{ old('jawaban') }}" required placeholder="Contoh: PHP">
                        @error('jawaban')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="urutan" class="form-label fw-bold">Urutan Tampilan</label>
                        <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', 1) }}" required>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Simpan Opsi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
