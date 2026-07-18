@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Tambah Framework Baru</h2>
            <a href="{{ route('admin.framework.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.framework.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="kategori_framework_id" class="form-label fw-bold">Kategori Framework</label>
                        <select class="form-select @error('kategori_framework_id') is-invalid @enderror" id="kategori_framework_id" name="kategori_framework_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_framework_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama }} ({{ $kat->kode }})
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_framework_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kode" class="form-label fw-bold">Kode Framework</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode') }}" required placeholder="Contoh: FW001">
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_framework" class="form-label fw-bold">Nama Framework</label>
                        <input type="text" class="form-control @error('nama_framework') is-invalid @enderror" id="nama_framework" name="nama_framework" value="{{ old('nama_framework') }}" required placeholder="Contoh: Laravel">
                        @error('nama_framework')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bahasa" class="form-label fw-bold">Bahasa Pemrograman</label>
                        <input type="text" class="form-control @error('bahasa') is-invalid @enderror" id="bahasa" name="bahasa" value="{{ old('bahasa') }}" required placeholder="Contoh: PHP">
                        @error('bahasa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="website" class="form-label fw-bold">Website Resmi</label>
                        <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="https://example.com">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" placeholder="Tuliskan deskripsi singkat mengenai framework ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Simpan Framework</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
