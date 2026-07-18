@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Edit Aturan Knowledge Base</h2>
            <a href="{{ route('admin.knowledge_base.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        @if($errors->has('error'))
            <div class="alert alert-danger">{{ $errors->first('error') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.knowledge_base.update', $knowledgeBase) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="framework_id" class="form-label fw-bold">Framework Target</label>
                        <select class="form-select @error('framework_id') is-invalid @enderror" id="framework_id" name="framework_id" required>
                            <option value="">-- Pilih Framework --</option>
                            @foreach($frameworks as $fw)
                                <option value="{{ $fw->id }}" {{ old('framework_id', $knowledgeBase->framework_id) == $fw->id ? 'selected' : '' }}>
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
                                <option value="{{ $p->id }}" {{ old('pertanyaan_id', $knowledgeBase->pertanyaan_id) == $p->id ? 'selected' : '' }}>
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
                            @foreach($opsiJawabans as $opt)
                                <option value="{{ $opt->id }}" {{ old('opsi_jawaban_id', $knowledgeBase->opsi_jawaban_id) == $opt->id ? 'selected' : '' }}>
                                    {{ $opt->jawaban }} ({{ $opt->kode }})
                                </option>
                            @endforeach
                        </select>
                        @error('opsi_jawaban_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cf_pakar" class="form-label fw-bold">Certainty Factor (CF Pakar)</label>
                        <p class="text-muted small">Nilai keyakinan dari pakar untuk opsi ini. Berada dalam rentang -1.0 hingga 1.0.</p>
                        <input type="number" step="0.01" class="form-control @error('cf_pakar') is-invalid @enderror" id="cf_pakar" name="cf_pakar" value="{{ old('cf_pakar', $knowledgeBase->cf_pakar) }}" required placeholder="Contoh: 0.85">
                        @error('cf_pakar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Perbarui Aturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Fetch all options dynamically for dynamic changes
    let allOptions = [];
    
    // We fetch via API or pass from PHP, but since it's an edit view we can load dynamically on question change
    // For convenience we can load the full options json to do dynamic filter
    fetch('/api/opsi-jawaban') // Note: if API is not setup, we can fallback to standard PHP render
    .then(r => r.json())
    .then(data => { allOptions = data; })
    .catch(e => console.log('Dynamic options load disabled, using preloaded PHP options.'));

    function filterOptions() {
        const qId = document.getElementById('pertanyaan_id').value;
        const optSelect = document.getElementById('opsi_jawaban_id');
        
        // If dynamic allOptions was loaded, filter it. Else do standard form reset
        if (allOptions.length > 0) {
            optSelect.innerHTML = '<option value="">-- Pilih Jawaban --</option>';
            const filtered = allOptions.filter(opt => opt.pertanyaan_id == qId);
            filtered.forEach(opt => {
                const el = document.createElement('option');
                el.value = opt.id;
                el.innerText = `${opt.jawaban} (${opt.kode})`;
                optSelect.appendChild(el);
            });
        }
    }
</script>
@endsection
