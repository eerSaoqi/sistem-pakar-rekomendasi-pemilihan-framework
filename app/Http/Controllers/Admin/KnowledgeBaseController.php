<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeBase;
use App\Models\Framework;
use App\Models\Pertanyaan;
use App\Models\OpsiJawaban;
use Illuminate\Http\Request;

class KnowledgeBaseController extends Controller
{
    public function index(Request $request)
    {
        $query = KnowledgeBase::with(['framework', 'pertanyaan', 'opsiJawaban']);

        if ($request->filled('framework_id')) {
            $query->where('framework_id', $request->framework_id);
        }

        $kbs = $query->latest()->paginate(15);
        $frameworks = Framework::all();

        return view('admin.knowledge_base.index', compact('kbs', 'frameworks'));
    }

    public function create()
    {
        $frameworks = Framework::all();
        $pertanyaans = Pertanyaan::orderBy('urutan')->get();
        $opsiJawabans = OpsiJawaban::orderBy('pertanyaan_id')->orderBy('urutan')->get();

        return view('admin.knowledge_base.create', compact('frameworks', 'pertanyaans', 'opsiJawabans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'framework_id' => 'required|exists:framework,id',
            'pertanyaan_id' => 'required|exists:pertanyaan,id',
            'opsi_jawaban_id' => 'required|exists:opsi_jawaban,id',
            'cf_pakar' => 'required|numeric|between:-1,1',
        ]);

        // Check uniqueness of rule mapping
        $exists = KnowledgeBase::where('framework_id', $request->framework_id)
            ->where('pertanyaan_id', $request->pertanyaan_id)
            ->where('opsi_jawaban_id', $request->opsi_jawaban_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['error' => 'Kombinasi aturan ini sudah terdaftar di Knowledge Base.']);
        }

        KnowledgeBase::create($request->all());

        return redirect()->route('admin.knowledge_base.index')
            ->with('success', 'Entri Knowledge Base berhasil ditambahkan.');
    }

    public function edit(KnowledgeBase $knowledgeBase)
    {
        $frameworks = Framework::all();
        $pertanyaans = Pertanyaan::orderBy('urutan')->get();
        
        // Load options specifically for the selected question
        $opsiJawabans = OpsiJawaban::where('pertanyaan_id', $knowledgeBase->pertanyaan_id)->get();

        return view('admin.knowledge_base.edit', compact('knowledgeBase', 'frameworks', 'pertanyaans', 'opsiJawabans'));
    }

    public function update(Request $request, KnowledgeBase $knowledgeBase)
    {
        $request->validate([
            'framework_id' => 'required|exists:framework,id',
            'pertanyaan_id' => 'required|exists:pertanyaan,id',
            'opsi_jawaban_id' => 'required|exists:opsi_jawaban,id',
            'cf_pakar' => 'required|numeric|between:-1,1',
        ]);

        // Check if there is another matching combination excluding current id
        $exists = KnowledgeBase::where('framework_id', $request->framework_id)
            ->where('pertanyaan_id', $request->pertanyaan_id)
            ->where('opsi_jawaban_id', $request->opsi_jawaban_id)
            ->where('id', '!=', $knowledgeBase->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['error' => 'Kombinasi aturan ini sudah terdaftar di Knowledge Base.']);
        }

        $knowledgeBase->update($request->all());

        return redirect()->route('admin.knowledge_base.index')
            ->with('success', 'Entri Knowledge Base berhasil diperbarui.');
    }

    public function destroy(KnowledgeBase $knowledgeBase)
    {
        $knowledgeBase->delete();
        return redirect()->route('admin.knowledge_base.index')
            ->with('success', 'Entri Knowledge Base berhasil dihapus.');
    }
}
