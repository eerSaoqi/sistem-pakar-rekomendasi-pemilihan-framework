@extends('layouts.main')

@section('title', 'Wizard Konsultasi - Advisor.CF')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card glass-card p-4 p-md-5">
                <div class="text-center mb-4">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-2">Expert System</span>
                    <h2 class="fw-extrabold mb-1">Rekomendasi Framework</h2>
                    <p class="text-muted">Temukan framework pemrograman terbaik untuk proyek Anda berdasarkan metode Certainty Factor.</p>
                </div>

                <!-- Wizard Progress -->
                <div class="step-progress px-md-5" id="wizard-progress">
                    <div class="step-indicator active" id="ind-1">1</div>
                    <div class="step-indicator" id="ind-2">2</div>
                    <div class="step-indicator" id="ind-3">3</div>
                </div>

                <form id="wizard-form" method="POST" action="{{ route('consultation.store') }}">
                    @csrf

                    <!-- STEP 1: Profil & Jenis Proyek -->
                    <div class="wizard-step" id="step-1">
                        <h4 class="mb-4 text-center fw-bold"><i class="bi bi-person-badge me-2 text-primary"></i>Profil &amp; Jenis Proyek</h4>
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-medium">Nama Anda</label>
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium d-block mb-3">Apa yang ingin Anda bangun?</label>
                            <div class="row g-3">
                                @foreach($jenisProyeks as $jp)
                                    <div class="col-sm-6">
                                        <div class="card h-100 p-3 category-card cursor-pointer" onclick="selectJenisProyek(this, {{ $jp->id }}, '{{ $jp->nama }}')">
                                            <div class="card-body p-0 text-center">
                                                <div class="fs-2 text-primary mb-2">
                                                    @switch($jp->kode)
                                                        @case('JP01') <i class="bi bi-globe2"></i> @break
                                                        @case('JP02') <i class="bi bi-speedometer2"></i> @break
                                                        @case('JP03') <i class="bi bi-diagram-3"></i> @break
                                                        @case('JP04') <i class="bi bi-braces-asterisk"></i> @break
                                                        @case('JP05') <i class="bi bi-cart4"></i> @break
                                                        @case('JP06') <i class="bi bi-phone"></i> @break
                                                        @case('JP07') <i class="bi bi-robot"></i> @break
                                                        @case('JP08') <i class="bi bi-building"></i> @break
                                                        @default <i class="bi bi-code-slash"></i>
                                                    @endswitch
                                                </div>
                                                <h5 class="fw-bold mb-1">{{ $jp->nama }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="jenis_proyek_id" id="jenis_proyek_id" required>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-gradient-primary px-4 py-2" id="btn-to-step-2" onclick="goToStep2()">
                                Lanjut Ke Pertanyaan <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: Pertanyaan & Jawaban (Dynamic via JS) -->
                    <div class="wizard-step d-none" id="step-2">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0 fw-bold"><i class="bi bi-patch-question me-2 text-primary"></i>Kuesioner Pemilihan</h4>
                            <span class="badge bg-secondary" id="question-counter">Pertanyaan 1 dari 10</span>
                        </div>

                        <!-- Single Question Card Container -->
                        <div id="question-container" class="mb-4">
                            <!-- Injected dynamically via JS -->
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2" onclick="prevQuestion()">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-gradient-primary px-4 py-2" id="btn-next-q" onclick="nextQuestion()">
                                Lanjut <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: Review & Submit -->
                    <div class="wizard-step d-none" id="step-3">
                        <h4 class="mb-4 text-center fw-bold"><i class="bi bi-check-circle me-2 text-success"></i>Siap Menghitung</h4>
                        <div class="text-center py-4 mb-4">
                            <div class="fs-1 text-success mb-3">
                                <i class="bi bi-calculator-fill animate-pulse"></i>
                            </div>
                            <p class="lead">Semua pertanyaan telah dijawab dengan tingkat keyakinan Anda.</p>
                            <p class="text-muted small">Sistem siap menghitung Certainty Factor untuk merekomendasikan framework yang paling cocok untuk Anda.</p>
                        </div>

                        <div class="card p-3 mb-4 rounded-3" style="background-color: var(--card-bg); border: 1px solid var(--border-color);">
                            <h6 class="fw-bold mb-2">Ringkasan Konsultasi:</h6>
                            <div class="row small g-2 text-muted">
                                <div class="col-sm-4 fw-medium text-dark">Nama:</div>
                                <div class="col-sm-8" id="summary-name">-</div>
                                <div class="col-sm-4 fw-medium text-dark">Email:</div>
                                <div class="col-sm-8" id="summary-email">-</div>
                                <div class="col-sm-4 fw-medium text-dark">Jenis Proyek:</div>
                                <div class="col-sm-8 text-primary fw-bold" id="summary-category">-</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2" onclick="backToStep2()">
                                <i class="bi bi-arrow-left me-1"></i> Perbaiki Jawaban
                            </button>
                            <button type="submit" class="btn btn-gradient-accent px-5 py-2">
                                <i class="bi bi-cpu me-1"></i> Dapatkan Rekomendasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .category-card {
        transition: all 0.3s ease;
    }
    .category-card:hover {
        border-color: #38DDCD !important;
        transform: translateY(-3px);
        background: rgba(56, 221, 205, 0.05) !important;
    }
    .category-card.selected {
        border-color: #38DDCD !important;
        background: rgba(56, 221, 205, 0.12) !important;
        box-shadow: 0 0 15px rgba(56, 221, 205, 0.3);
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .option-select-card {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .option-select-card:hover {
        border-color: #38DDCD !important;
        background: rgba(56, 221, 205, 0.05) !important;
    }
    .option-select-card.selected {
        border-color: #38DDCD !important;
        background: rgba(56, 221, 205, 0.1) !important;
    }
</style>
@endsection

@section('scripts')
<script>
    let questions = [];
    let currentQuestionIndex = 0;
    let selectedJenisProyekName = '';

    // Handle Jenis Proyek Selection
    function selectJenisProyek(card, id, name) {
        document.querySelectorAll('.category-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        document.getElementById('jenis_proyek_id').value = id;
        selectedJenisProyekName = name;
    }

    // Go from Step 1 to Step 2
    function goToStep2() {
        const nama = document.getElementById('nama').value.trim();
        const email = document.getElementById('email').value.trim();
        const jpId = document.getElementById('jenis_proyek_id').value;

        if (!nama || !email || !jpId) {
            alert('Silakan lengkapi nama, email, dan pilih jenis proyek terlebih dahulu!');
            return;
        }

        // Fetch questions via AJAX
        fetch('{{ route("consultation.get-questions") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ jenis_proyek_id: jpId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.questions.length > 0) {
                questions = data.questions;
                currentQuestionIndex = 0;
                
                // Show Step 2
                document.getElementById('step-1').classList.add('d-none');
                document.getElementById('step-2').classList.remove('d-none');
                
                document.getElementById('ind-1').classList.replace('active', 'completed');
                document.getElementById('ind-2').classList.add('active');

                renderQuestion();
            } else {
                alert('Tidak ada pertanyaan yang tersedia untuk jenis proyek ini.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat memuat pertanyaan.');
        });
    }

    // Render current question
    function renderQuestion() {
        const q = questions[currentQuestionIndex];
        const container = document.getElementById('question-container');
        document.getElementById('question-counter').innerText = `Pertanyaan ${currentQuestionIndex + 1} dari ${questions.length}`;

        // Options generator
        let optionsHtml = '';
        q.opsi_jawabans.forEach(opt => {
            // Check if this option was already selected
            const savedAns = document.getElementById(`opt_hidden_${q.id}`);
            const isSelected = savedAns && savedAns.value == opt.id ? 'selected' : '';
            const isChecked = savedAns && savedAns.value == opt.id ? 'checked' : '';

            optionsHtml += `
                <div class="card mb-2 option-select-card ${isSelected}" onclick="selectOption(this, ${q.id}, ${opt.id})">
                    <div class="card-body py-2 px-3 d-flex align-items-center">
                        <input class="form-check-input me-3" type="radio" name="answers[${q.id}][opsi_jawaban_id]" id="opt_${opt.id}" value="${opt.id}" required ${isChecked} style="pointer-events: none;">
                        <label class="form-check-label mb-0 cursor-pointer" for="opt_${opt.id}">${opt.jawaban}</label>
                    </div>
                </div>
            `;
        });

        // Get already selected CF value or default to 1.0 (Pasti)
        let inputCf = document.getElementById(`cf_hidden_${q.id}`);
        if (!inputCf) {
            inputCf = document.createElement('input');
            inputCf.type = 'hidden';
            inputCf.name = `answers[${q.id}][cf_user]`;
            inputCf.id = `cf_hidden_${q.id}`;
            document.getElementById('wizard-form').appendChild(inputCf);
            inputCf.value = 1.0;
        }
        const savedCF = parseFloat(inputCf.value);

        const cfOptions = [
            { value: 1.0, label: 'Sangat Yakin' },
            { value: 0.8, label: 'Yakin' },
            { value: 0.6, label: 'Cukup Yakin' },
            { value: 0.4, label: 'Sedikit Yakin' },
            { value: 0.2, label: 'Tidak Tahu / Tidak Yakin' },
            { value: 0.0, label: 'Tidak Butuh' }
        ];

        let cfHtml = '';
        cfOptions.forEach(cfOpt => {
            const isSelected = Math.abs(savedCF - cfOpt.value) < 0.01 ? 'selected' : '';
            cfHtml += `
                <div class="cf-option ${isSelected}" data-val="${cfOpt.value}" onclick="selectCF(this, ${q.id}, ${cfOpt.value})">
                    <div class="fw-bold">${cfOpt.value}</div>
                    <div class="small text-muted">${cfOpt.label}</div>
                </div>
            `;
        });

        // Build HTML
        container.innerHTML = `
            <div class="mb-4">
                <h5 class="fw-semibold mb-3">${q.pertanyaan}</h5>
                <div class="options-group mb-4">
                    ${optionsHtml}
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-medium mb-2"><i class="bi bi-bar-chart-fill text-primary me-2"></i>Tingkat Keyakinan Anda terhadap Pilihan Tersebut:</label>
                <div class="cf-selector">
                    ${cfHtml}
                </div>
            </div>
        `;
    }

    function selectOption(card, questionId, optionId) {
        // Unselect other options in this question container
        const optionsGroup = card.closest('.options-group');
        optionsGroup.querySelectorAll('.option-select-card').forEach(c => c.classList.remove('selected'));
        optionsGroup.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);

        // Select clicked option
        card.classList.add('selected');
        const radio = card.querySelector('input[type="radio"]');
        radio.checked = true;

        // Ensure we create / maintain the values in form
        let inputOpt = document.getElementById(`opt_hidden_${questionId}`);
        if (!inputOpt) {
            inputOpt = document.createElement('input');
            inputOpt.type = 'hidden';
            inputOpt.name = `answers[${questionId}][opsi_jawaban_id]`;
            inputOpt.id = `opt_hidden_${questionId}`;
            document.getElementById('wizard-form').appendChild(inputOpt);
        }
        inputOpt.value = optionId;
    }

    function selectCF(optionElement, questionId, value) {
        // Unselect other CF options
        const parent = optionElement.closest('.cf-selector');
        parent.querySelectorAll('.cf-option').forEach(el => el.classList.remove('selected'));

        // Select clicked
        optionElement.classList.add('selected');

        // Set hidden value
        let inputCf = document.getElementById(`cf_hidden_${questionId}`);
        if (!inputCf) {
            inputCf = document.createElement('input');
            inputCf.type = 'hidden';
            inputCf.name = `answers[${questionId}][cf_user]`;
            inputCf.id = `cf_hidden_${questionId}`;
            document.getElementById('wizard-form').appendChild(inputCf);
        }
        inputCf.value = value;
    }

    function nextQuestion() {
        const q = questions[currentQuestionIndex];
        const selectedOpt = document.getElementById(`opt_hidden_${q.id}`);

        if (!selectedOpt || !selectedOpt.value) {
            alert('Silakan pilih salah satu jawaban terlebih dahulu!');
            return;
        }

        if (currentQuestionIndex < questions.length - 1) {
            currentQuestionIndex++;
            renderQuestion();
        } else {
            // End of questions, go to Step 3
            goToStep3();
        }
    }

    function prevQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            renderQuestion();
        } else {
            // Go back to Step 1
            document.getElementById('step-2').classList.add('d-none');
            document.getElementById('step-1').classList.remove('d-none');
            
            document.getElementById('ind-1').classList.replace('completed', 'active');
            document.getElementById('ind-2').classList.remove('active');
        }
    }

    // Go to Step 3
    function goToStep3() {
        document.getElementById('step-2').classList.add('d-none');
        document.getElementById('step-3').classList.remove('d-none');

        document.getElementById('ind-2').classList.replace('active', 'completed');
        document.getElementById('ind-3').classList.add('active');

        // Populate summary
        document.getElementById('summary-name').innerText = document.getElementById('nama').value;
        document.getElementById('summary-email').innerText = document.getElementById('email').value;
        document.getElementById('summary-category').innerText = selectedJenisProyekName;
    }

    function backToStep2() {
        document.getElementById('step-3').classList.add('d-none');
        document.getElementById('step-2').classList.remove('d-none');

        document.getElementById('ind-2').classList.replace('completed', 'active');
        document.getElementById('ind-3').classList.remove('active');
    }
</script>
@endsection
