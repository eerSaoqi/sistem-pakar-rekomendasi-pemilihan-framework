@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2 class="mb-1">Edit Kategori Framework</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.kategori_framework.index') }}">Kategori Framework</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit - {{ $kategoriFramework->nama }}</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.kategori_framework.update', $kategoriFramework) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="kode" class="form-label fw-medium">Kode Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode', $kategoriFramework->kode) }}" required maxlength="10">
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-8">
                    <label for="nama" class="form-label fw-medium">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $kategoriFramework->nama) }}" required maxlength="50">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label fw-medium">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $kategoriFramework->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.kategori_framework.index') }}" class="btn btn-light border">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
