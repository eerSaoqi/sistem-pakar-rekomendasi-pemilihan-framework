@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Detail Riwayat Konsultasi #{{ $konsultasi->id }}</h2>
    <a href="{{ route('admin.history.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-4">
    <!-- User Profile & Results -->
    <div class="col-md-5">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-dark text-white fw-bold">
                <i class="bi bi-person-badge me-1"></i> Profil Pengguna
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <th width="120">Nama:</th>
                        <td>{{ $konsultasi->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $konsultasi->email }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal:</th>
                        <td>{{ $konsultasi->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Proyek:</th>
                        <td><span class="badge bg-primary">{{ $konsultasi->jenisProyek->nama ?? '-' }}</span></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white fw-bold">
                <i class="bi bi-trophy me-1"></i> Hasil Rekomendasi (Ranking)
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr class="table-light">
                                <th class="ps-3" width="80">Rank</th>
                                <th>Framework</th>
                                <th>Nilai CF</th>
                                <th class="pe-3">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($konsultasi->hasilKonsultasis as $hasil)
                            <tr class="{{ $hasil->ranking == 1 ? 'table-warning fw-bold' : '' }}">
                                <td class="ps-3">#{{ $hasil->ranking }}</td>
                                <td>{{ $hasil->framework->nama_framework }}</td>
                                <td>{{ number_format($hasil->nilai_cf, 4) }}</td>
                                <td class="pe-3">{{ number_format($hasil->persentase, 1) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Answers Log -->
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-chat-left-text me-1"></i> Log Jawaban &amp; Keyakinan (CF User)
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr class="table-light">
                                <th class="ps-3" width="70">Kode</th>
                                <th>Pertanyaan</th>
                                <th>Pilihan User</th>
                                <th class="pe-3" width="100">CF User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($konsultasi->jawabanKonsultasis as $j)
                            <tr>
                                <td class="ps-3"><span class="badge bg-secondary">{{ $j->pertanyaan->kode }}</span></td>
                                <td class="text-wrap small" style="max-width: 250px;">{{ $j->pertanyaan->pertanyaan }}</td>
                                <td class="fw-medium small text-primary">{{ $j->opsiJawaban->jawaban }}</td>
                                <td class="pe-3 fw-bold">{{ number_format($j->cf_user, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<!-- Detail Perhitungan CF Langkah Demi Langkah -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-info text-white fw-bold">
                <i class="bi bi-calculator me-1"></i> Detail Perhitungan Certainty Factor
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">
                    <strong>Keterangan Istilah:</strong>
                    Hipotesis (H) = Framework yang Direkomendasikan &nbsp;|&nbsp;
                    Evidence (E) = Kebutuhan/Kriteria Pengguna &nbsp;|&nbsp;
                    Pakar = Software Engineer/Developer
                </p>

                <div class="accordion" id="adminCfAccordion">
                    @php $accIdx = 0; @endphp
                    @foreach($calculationDetails as $fwId => $detail)
                        @php
                            $fw = $detail['framework'];
                            $accIdx++;
                        @endphp
                        <div class="accordion-item border mb-2 rounded-3 overflow-hidden">
                            <h2 class="accordion-header" id="admin-heading-{{ $fwId }}">
                                <button class="accordion-button {{ $accIdx > 1 ? 'collapsed' : '' }} fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#admin-collapse-{{ $fwId }}"
                                        aria-expanded="{{ $accIdx === 1 ? 'true' : 'false' }}">
                                    <span class="me-2">{{ $fw->nama_framework }}</span>
                                    <span class="badge {{ $detail['persentase'] > 0 ? 'bg-success' : 'bg-secondary' }} ms-auto me-2">
                                        {{ number_format($detail['persentase'], 2) }}%
                                    </span>
                                </button>
                            </h2>
                            <div id="admin-collapse-{{ $fwId }}" class="accordion-collapse collapse {{ $accIdx === 1 ? 'show' : '' }}"
                                 data-bs-parent="#adminCfAccordion">
                                <div class="accordion-body">
                                    @if(count($detail['steps']) > 0)
                                        <h6 class="fw-bold text-primary mb-2">Langkah 1: CF(H,E) = CF(User) × CF(Pakar)</h6>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-sm table-bordered table-striped mb-0 align-middle">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Kebutuhan (Evidence)</th>
                                                        <th>Jawaban</th>
                                                        <th class="text-center">CF User</th>
                                                        <th class="text-center">CF Pakar</th>
                                                        <th class="text-center">CF(H,E)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($detail['steps'] as $step)
                                                        <tr>
                                                            <td><span class="badge bg-secondary">{{ $step['pertanyaan_kode'] }}</span></td>
                                                            <td class="small">{{ $step['pertanyaan_text'] }}</td>
                                                            <td class="small fw-medium text-primary">{{ $step['opsi_jawaban'] }}</td>
                                                            <td class="text-center">{{ number_format($step['cf_user'], 2) }}</td>
                                                            <td class="text-center">{{ number_format($step['cf_pakar'], 2) }}</td>
                                                            <td class="text-center fw-bold">{{ number_format($step['cf_value'], 4) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        @if(count($detail['combine_steps']) > 0)
                                            <h6 class="fw-bold text-primary mb-2">Langkah 2: CF Combine</h6>
                                            <div class="table-responsive mb-3">
                                                <table class="table table-sm table-bordered mb-0 align-middle">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th class="text-center" width="60">Step</th>
                                                            <th>Perhitungan</th>
                                                            <th class="text-center" width="120">Hasil</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($detail['combine_steps'] as $cs)
                                                            <tr>
                                                                <td class="text-center">{{ $cs['step'] }}</td>
                                                                <td class="small font-monospace">{{ $cs['formula'] }}</td>
                                                                <td class="text-center fw-bold">{{ number_format($cs['cf_combined'], 4) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif

                                        <div class="alert alert-success py-2 mb-0">
                                            <strong>Nilai CF Akhir {{ $fw->nama_framework }}:</strong>
                                            {{ number_format($detail['combined_cf'], 4) }}
                                            ({{ number_format($detail['persentase'], 2) }}%)
                                        </div>
                                    @else
                                        @if(!empty($detail['filtered_by_language']))
                                            <div class="alert alert-warning py-2 mb-0">
                                                <i class="bi bi-funnel-fill me-1"></i>
                                                <strong>Difilter: Bahasa Tidak Cocok.</strong>
                                                Framework <strong>{{ $fw->nama_framework }}</strong> menggunakan bahasa <strong>{{ $fw->bahasa }}</strong>
                                                yang berbeda dari bahasa pemrograman yang dipilih pengguna. CF = 0%.
                                            </div>
                                        @else
                                            <div class="alert alert-secondary py-2 mb-0">
                                                Tidak ada kecocokan kebutuhan pengguna dengan knowledge base untuk <strong>{{ $fw->nama_framework }}</strong>. Nilai CF = 0%.
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
