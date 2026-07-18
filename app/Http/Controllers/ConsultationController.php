<?php

namespace App\Http\Controllers;

use App\Models\JenisProyek;
use App\Models\Pertanyaan;
use App\Models\OpsiJawaban;
use App\Models\Konsultasi;
use App\Models\Framework;
use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    protected CertaintyFactorService $cfService;

    public function __construct(CertaintyFactorService $cfService)
    {
        $this->cfService = $cfService;
    }

    /**
     * Step 1: Display the wizard with Jenis Proyek from database.
     */
    public function index()
    {
        $jenisProyeks = JenisProyek::all();
        return view('consultation.index', compact('jenisProyeks'));
    }

    /**
     * AJAX: Get relevant questions based on jenis_proyek_id.
     * Reads jenis_proyek_kategori -> kategori_pertanyaan -> pertanyaan + opsi_jawaban.
     */
    public function getQuestions(Request $request)
    {
        $request->validate([
            'jenis_proyek_id' => 'required|exists:jenis_proyek,id'
        ]);

        $jenisProyek = JenisProyek::with('kategoriFrameworks')->find($request->jenis_proyek_id);

        // Get all category IDs linked to this jenis proyek
        $kategoriIds = $jenisProyek->kategoriFrameworks->pluck('id')->toArray();

        // Get all unique languages supported by frameworks in those categories
        $frameworks = Framework::whereIn('kategori_framework_id', $kategoriIds)->get();
        $supportedLanguages = $frameworks->pluck('bahasa')->unique()->toArray();

        // Get all unique pertanyaan linked to those categories, excluding JP01 (answered in Step 1)
        $questions = Pertanyaan::where('aktif', true)
            ->where('kode', '!=', 'JP01')
            ->whereHas('kategoriFrameworks', function ($q) use ($kategoriIds) {
                $q->whereIn('kategori_framework.id', $kategoriIds);
            })
            ->with('opsiJawabans')
            ->orderBy('urutan')
            ->distinct()
            ->get();

        // Filter the programming language options (P01) to only show languages supported in this project type
        $questions->map(function ($q) use ($supportedLanguages) {
            if ($q->kode === 'P01') {
                $filteredOptions = $q->opsiJawabans->filter(function ($opt) use ($supportedLanguages) {
                    return in_array($opt->jawaban, $supportedLanguages);
                })->values();
                $q->setRelation('opsiJawabans', $filteredOptions);
            }
            return $q;
        });

        return response()->json([
            'success' => true,
            'questions' => $questions
        ]);
    }

    /**
     * Step 3: Process form submission and calculate CF.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'jenis_proyek_id' => 'required|exists:jenis_proyek,id',
            'answers' => 'required|array',
            'answers.*.opsi_jawaban_id' => 'required|exists:opsi_jawaban,id',
            'answers.*.cf_user' => 'required|numeric|between:0,1',
        ]);

        // Inject JP01 answer dynamically from selected jenis_proyek_id
        $jenisProyek = JenisProyek::find($request->jenis_proyek_id);
        $jpQuestion = Pertanyaan::where('kode', 'JP01')->first();
        
        $jpOpsi = OpsiJawaban::where('pertanyaan_id', $jpQuestion->id)
            ->where('jawaban', $jenisProyek->nama)
            ->first();

        $answers = $request->answers;
        if ($jpOpsi) {
            $answers[$jpQuestion->id] = [
                'opsi_jawaban_id' => $jpOpsi->id,
                'cf_user' => 1.0 // 100% Certainty for project type choice
            ];
        }

        $konsultasi = $this->cfService->calculate(
            $request->jenis_proyek_id,
            $request->nama,
            $request->email,
            $answers
        );

        return redirect()->route('consultation.results', $konsultasi->id);
    }

    /**
     * Display consultation results with framework rankings.
     */
    public function results($id)
    {
        $konsultasi = Konsultasi::with([
            'jenisProyek',
            'hasilKonsultasis' => function ($query) {
                $query->orderBy('ranking');
            },
            'hasilKonsultasis.framework.kategoriFramework'
        ])->findOrFail($id);

        $topRecommendations = $konsultasi->hasilKonsultasis->take(3);
        $alternatives = $konsultasi->hasilKonsultasis->slice(3);

        // Get detailed calculation steps
        $calculationDetails = $this->cfService->getCalculationDetails($konsultasi);

        return view('consultation.results', compact('konsultasi', 'topRecommendations', 'alternatives', 'calculationDetails'));
    }
}
