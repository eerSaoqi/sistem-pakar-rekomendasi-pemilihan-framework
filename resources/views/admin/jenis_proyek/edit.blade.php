@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Edit Jenis Proyek</h2>
            <a href="{{ route('admin.jenis_proyek.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.jenis_proyek.update', $jenisProyek) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kode" class="form-label fw-bold">Kode Proyek</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode', $jenisProyek->kode) }}" required placeholder="Contoh: JP01">
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Jenis Proyek</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $jenisProyek->nama) }}" required placeholder="Contoh: Website Company Profile">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold d-block">Kategori Framework yang Aktif</label>
                        <p class="text-muted small">Pilih kategori framework yang dapat direkomendasikan untuk jenis proyek ini.</p>
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
                        <button type="submit" class="btn btn-primary px-4">Perbarui Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
