@extends('layouts.main')

@section('title', 'Hasil Konsultasi - Advisor.CF')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Header -->
            <div class="text-center mb-5">
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-2">Hasil Analisis</span>
                <h2 class="fw-bold mb-1">Rekomendasi Framework untuk Anda</h2>
                <p class="text-muted">Berdasarkan profil <strong class="text-dark">{{ $konsultasi->nama }}</strong> &mdash; Jenis Proyek <strong class="text-primary">{{ $konsultasi->jenisProyek->nama }}</strong></p>
            </div>

            <!-- Top 3 Recommendations -->
            <div class="row g-4 mb-5">
                @foreach($topRecommendations as $index => $hasil)
                    @php
                        $colors = ['#3b82f6', '#8b5cf6', '#10b981'];
                        $medals = ['🥇', '🥈', '🥉'];
                        $borderColor = $colors[$index] ?? '#6b7280';
                        $medal = $medals[$index] ?? '';
                        $fw = $hasil->framework;
                    @endphp
                    <div class="col-md-4">
                        <div class="card glass-card h-100 p-4 position-relative overflow-hidden" style="border-top: 3px solid {{ $borderColor }};">
                            @if($index === 0)
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-warning text-dark fw-bold px-3 py-2">
                                        <i class="bi bi-trophy-fill me-1"></i>TOP PICK
                                    </span>
                                </div>
                            @endif

                            <div class="text-center mb-3">
                                <span class="fs-1">{{ $medal }}</span>
                                <h4 class="fw-bold mt-2 mb-0">{{ $fw->nama_framework }}</h4>
                                <small class="text-muted">{{ $fw->bahasa }} ({{ $fw->kategoriFramework->nama }})</small>
                            </div>

                            <div class="text-center mb-3">
                                <div class="percentage-badge">{{ number_format($hasil->persentase, 1) }}%</div>
                                <div class="small text-muted mt-1">Certainty Factor: {{ number_format($hasil->nilai_cf, 4) }}</div>
                            </div>

                            <!-- Progress bar -->
                            <div class="progress mb-3" style="height: 8px; background: rgba(0,0,0,0.05);">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $hasil->persentase }}%; background: {{ $borderColor }};"
                                     aria-valuenow="{{ $hasil->persentase }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">{{ $fw->deskripsi }}</small>
                            </div>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-secondary text-dark">Ranking #{{ $hasil->ranking }}</span>
                                    @if($fw->website)
                                        <a href="{{ $fw->website }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-box-arrow-up-right me-1"></i>Website
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Mengapa framework ini direkomendasikan -->
            @if($topRecommendations->isNotEmpty())
                @php $top = $topRecommendations->first(); @endphp
                <div class="card glass-card p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-lightbulb-fill text-warning me-2"></i>Mengapa <span class="text-primary">{{ $top->framework->nama_framework }}</span> Direkomendasikan?</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Framework ini memiliki tingkat kesesuaian tertinggi (<strong>{{ number_format($top->persentase, 1) }}%</strong>) berdasarkan kebutuhan yang Anda berikan.
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Knowledge base menunjukkan kecocokan terbaik antara kriteria pengguna dengan karakteristik <strong>{{ $top->framework->nama_framework }}</strong>.
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Berbasis bahasa <strong>{{ $top->framework->bahasa }}</strong> yang sesuai dengan preferensi Anda.
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Nilai Certainty Factor dihitung dari {{ $konsultasi->jawabanKonsultasis->count() }} kebutuhan/kriteria yang Anda berikan dengan bobot keyakinan masing-masing.
                        </li>
                    </ul>
                </div>
            @endif

            <!-- Alternatif Lainnya -->
            @if($alternatives->isNotEmpty())
                <div class="card glass-card p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-list-stars text-info me-2"></i>Alternatif Lainnya</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0 align-middle">
                            <thead>
                                <tr class="text-muted small">
                                    <th>Ranking</th>
                                    <th>Framework</th>
                                    <th>Bahasa</th>
                                    <th>CF</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alternatives as $alt)
                                    <tr>
                                        <td><span class="badge bg-secondary">#{{ $alt->ranking }}</span></td>
                                        <td class="fw-medium">{{ $alt->framework->nama_framework }}</td>
                                        <td class="text-muted small">{{ $alt->framework->bahasa }}</td>
                                        <td>{{ number_format($alt->nilai_cf, 4) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress flex-grow-1" style="height: 6px; background: rgba(0,0,0,0.05);">
                                                    <div class="progress-bar bg-secondary" style="width: {{ $alt->persentase }}%;"></div>
                                                </div>
                                                <span class="small">{{ number_format($alt->persentase, 1) }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="text-center">
                <a href="{{ url('/') }}" class="btn btn-gradient-primary px-5 py-2 me-2">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Konsultasi Baru
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
