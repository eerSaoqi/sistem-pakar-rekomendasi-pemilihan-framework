@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Edit Pertanyaan</h2>
            <a href="{{ route('admin.pertanyaan.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.pertanyaan.update', $pertanyaan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kode" class="form-label fw-bold">Kode Pertanyaan</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode', $pertanyaan->kode) }}" required placeholder="Contoh: P01">
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label fw-bold">Pertanyaan</label>
                        <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan" rows="3" required placeholder="Tuliskan isi pertanyaan...">{{ old('pertanyaan', $pertanyaan->pertanyaan) }}</textarea>
                        @error('pertanyaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tipe" class="form-label fw-bold">Tipe Pilihan</label>
                            <select class="form-select @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required>
                                <option value="radio" {{ old('tipe', $pertanyaan->tipe) == 'radio' ? 'selected' : '' }}>Radio (Single Choice)</option>
                                <option value="checkbox" {{ old('tipe', $pertanyaan->tipe) == 'checkbox' ? 'selected' : '' }}>Checkbox (Multiple Choice)</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="urutan" class="form-label fw-bold">Urutan</label>
                            <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $pertanyaan->urutan) }}" required>
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="aktif" class="form-label fw-bold">Status Aktif</label>
                        <select class="form-select @error('aktif') is-invalid @enderror" id="aktif" name="aktif" required>
                            <option value="1" {{ old('aktif', $pertanyaan->aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('aktif', $pertanyaan->aktif) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('aktif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold d-block">Asosiasi Kategori Framework</label>
                        <p class="text-muted small">Pilih kategori framework yang pertanyaannya relevan dengan kelompok ini.</p>
                        <div class="row g-2">
                            @foreach($kategoris as $kat)
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kategori_ids[]" value="{{ $kat->id }}" id="kat_{{ $kat->id }}" {{ in_array($kat->id, old('kategori_ids', $selectedKategoriIds)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kat_{{ $kat->id }}">
                                            {{ $kat->nama }} ({{ $kat->kode }})
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('kategori_ids')
                            <div class="text-danger small mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Perbarui Pertanyaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
