<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Consultation Routes
Route::get('/', [ConsultationController::class, 'index'])->name('consultation.index');
Route::post('/consultation/get-questions', [ConsultationController::class, 'getQuestions'])->name('consultation.get-questions');
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');
Route::get('/consultation/{id}/results', [ConsultationController::class, 'results'])->name('consultation.results');

// Breeze Dashboard (Admin)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('kategori_framework', App\Http\Controllers\Admin\KategoriFrameworkController::class);
    Route::resource('jenis_proyek', App\Http\Controllers\Admin\JenisProyekController::class);
    Route::resource('framework', App\Http\Controllers\Admin\FrameworkController::class);
    Route::resource('pertanyaan', App\Http\Controllers\Admin\PertanyaanController::class);
    Route::resource('opsi_jawaban', App\Http\Controllers\Admin\OpsiJawabanController::class);
    Route::resource('knowledge_base', App\Http\Controllers\Admin\KnowledgeBaseController::class);
    Route::get('history', [App\Http\Controllers\Admin\HistoryController::class, 'index'])->name('history.index');
    Route::get('history/{id}', [App\Http\Controllers\Admin\HistoryController::class, 'show'])->name('history.show');
    Route::delete('history/{id}', [App\Http\Controllers\Admin\HistoryController::class, 'destroy'])->name('history.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // AJAX Helpers
    Route::get('/api/opsi-jawaban', function() {
        return App\Models\OpsiJawaban::all();
    })->name('api.opsi-jawaban');
});

require __DIR__.'/auth.php';
