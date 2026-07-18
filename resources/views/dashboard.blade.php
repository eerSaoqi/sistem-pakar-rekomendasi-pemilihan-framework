@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Dashboard Overview</h2>
    
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Kategori Framework</h5>
                    <h2 class="display-5">{{\App\Models\KategoriFramework::count()}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Framework</h5>
                    <h2 class="display-5">{{\App\Models\Framework::count()}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Pertanyaan</h5>
                    <h2 class="display-5">{{\App\Models\Pertanyaan::count()}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Konsultasi</h5>
                    <h2 class="display-5">{{\App\Models\Konsultasi::count()}}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
