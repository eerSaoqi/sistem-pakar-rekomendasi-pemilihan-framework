@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Tambah Aturan Knowledge Base</h2>
            <a href="{{ route('admin.knowledge_base.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        @if($errors->has('error'))
            <div class="alert alert-danger">{{ $errors->first('error') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.knowledge_base.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="framework_id" class="form-label fw-bold">Framework Target</label>
                        <select class="form-select @error('framework_id') is-invalid @enderror" id="framework_id" name="framework_id" required>
                            <option value="">-- Pilih Framework --</option>
                            @foreach($frameworks as $fw)
                                <option value="{{ $fw->id }}" {{ old('framework_id') == $fw->id ? 'selected' : '' }}>
                                    {{ $fw->nama_framework }} ({{ $fw->kode }} - {{ $fw->bahasa }})
                                </option>
                            @endforeach
                        </select>
                        @error('framework_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pertanyaan_id" class="form-label fw-bold">Kriteria Pertanyaan</label>
                        <select class="form-select @error('pertanyaan_id') is-invalid @enderror" id="pertanyaan_id" name="pertanyaan_id" required onchange="filterOptions()">
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
                        <label for="opsi_jawaban_id" class="form-label fw-bold">Pilihan Jawaban</label>
                        <select class="form-select @error('opsi_jawaban_id') is-invalid @enderror" id="opsi_jawaban_id" name="opsi_jawaban_id" required>
                            <option value="">-- Pilih Jawaban --</option>
                            <!-- Dynamically loaded via JS -->
                        </select>
                        @error('opsi_jawaban_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cf_pakar" class="form-label fw-bold">Certainty Factor (CF Pakar)</label>
                        <p class="text-muted small">Nilai keyakinan dari pakar untuk opsi ini. Berada dalam rentang -1.0 hingga 1.0.</p>
                        <input type="number" step="0.01" class="form-control @error('cf_pakar') is-invalid @enderror" id="cf_pakar" name="cf_pakar" value="{{ old('cf_pakar', '0.00') }}" required placeholder="Contoh: 0.85">
                        @error('cf_pakar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Simpan Aturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const options = @json($opsiJawabans);
    
    function filterOptions() {
        const qId = document.getElementById('pertanyaan_id').value;
        const optSelect = document.getElementById('opsi_jawaban_id');
        optSelect.innerHTML = '<option value="">-- Pilih Jawaban --</option>';
        
        if (!qId) return;

        const filtered = options.filter(opt => opt.pertanyaan_id == qId);
        filtered.forEach(opt => {
            const el = document.createElement('option');
            el.value = opt.id;
            el.innerText = `${opt.jawaban} (${opt.kode})`;
            if (opt.id == "{{ old('opsi_jawaban_id') }}") {
                el.selected = true;
            }
            optSelect.appendChild(el);
        });
    }

    // Trigger on load if old value exists
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('pertanyaan_id').value) {
            filterOptions();
        }
    });
</script>
@endsection
