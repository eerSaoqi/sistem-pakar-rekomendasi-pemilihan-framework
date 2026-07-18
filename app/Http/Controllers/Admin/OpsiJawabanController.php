<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpsiJawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class OpsiJawabanController extends Controller
{
    public function index()
    {
        $opsiJawabans = OpsiJawaban::with('pertanyaan')->orderBy('pertanyaan_id')->orderBy('urutan')->paginate(15);
        return view('admin.opsi_jawaban.index', compact('opsiJawabans'));
    }

    public function create()
    {
        $pertanyaans = Pertanyaan::all();
        return view('admin.opsi_jawaban.create', compact('pertanyaans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan_id' => 'required|exists:pertanyaan,id',
            'kode' => 'required|string|max:10|unique:opsi_jawaban',
            'jawaban' => 'required|string',
            'urutan' => 'required|integer',
        ]);

        OpsiJawaban::create($request->all());

        return redirect()->route('admin.opsi_jawaban.index')
            ->with('success', 'Opsi Jawaban berhasil ditambahkan.');
    }

    public function edit(OpsiJawaban $opsiJawaban)
    {
        $pertanyaans = Pertanyaan::all();
        return view('admin.opsi_jawaban.edit', compact('opsiJawaban', 'pertanyaans'));
    }

    public function update(Request $request, OpsiJawaban $opsiJawaban)
    {
        $request->validate([
            'pertanyaan_id' => 'required|exists:pertanyaan,id',
            'kode' => 'required|string|max:10|unique:opsi_jawaban,kode,' . $opsiJawaban->id,
            'jawaban' => 'required|string',
            'urutan' => 'required|integer',
        ]);

        $opsiJawaban->update($request->all());

        return redirect()->route('admin.opsi_jawaban.index')
            ->with('success', 'Opsi Jawaban berhasil diperbarui.');
    }

    public function destroy(OpsiJawaban $opsiJawaban)
    {
        $opsiJawaban->delete();
        return redirect()->route('admin.opsi_jawaban.index')
            ->with('success', 'Opsi Jawaban berhasil dihapus.');
    }
}
