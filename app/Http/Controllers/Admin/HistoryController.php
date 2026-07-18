<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    protected CertaintyFactorService $cfService;

    public function __construct(CertaintyFactorService $cfService)
    {
        $this->cfService = $cfService;
    }

    public function index()
    {
        $konsultasis = Konsultasi::with('jenisProyek')->latest()->paginate(10);
        return view('admin.history.index', compact('konsultasis'));
    }

    public function show($id)
    {
        $konsultasi = Konsultasi::with([
            'jenisProyek',
            'jawabanKonsultasis.pertanyaan',
            'jawabanKonsultasis.opsiJawaban',
            'hasilKonsultasis' => function ($query) {
                $query->orderBy('ranking');
            },
            'hasilKonsultasis.framework'
        ])->findOrFail($id);

        // Get detailed calculation steps
        $calculationDetails = $this->cfService->getCalculationDetails($konsultasi);

        return view('admin.history.show', compact('konsultasi', 'calculationDetails'));
    }

    public function destroy($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();

        return redirect()->route('admin.history.index')
            ->with('success', 'Riwayat konsultasi berhasil dihapus.');
    }
}
