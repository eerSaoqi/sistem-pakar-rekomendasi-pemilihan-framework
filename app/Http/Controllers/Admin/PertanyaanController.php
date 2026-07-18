<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\KategoriFramework;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaans = Pertanyaan::with('kategoriFrameworks')->orderBy('urutan')->paginate(10);
        return view('admin.pertanyaan.index', compact('pertanyaans'));
    }

    public function create()
    {
        $kategoris = KategoriFramework::all();
        return view('admin.pertanyaan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:pertanyaan',
            'pertanyaan' => 'required|string',
            'tipe' => 'required|string|max:20',
            'urutan' => 'required|integer',
            'aktif' => 'required|boolean',
            'kategori_ids' => 'required|array',
            'kategori_ids.*' => 'exists:kategori_framework,id',
        ]);

        $pertanyaan = Pertanyaan::create([
            'kode' => $request->kode,
            'pertanyaan' => $request->pertanyaan,
            'tipe' => $request->tipe,
            'urutan' => $request->urutan,
            'aktif' => $request->aktif,
        ]);

        $pertanyaan->kategoriFrameworks()->sync($request->kategori_ids);

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        $kategoris = KategoriFramework::all();
        $selectedKategoriIds = $pertanyaan->kategoriFrameworks->pluck('id')->toArray();
        return view('admin.pertanyaan.edit', compact('pertanyaan', 'kategoris', 'selectedKategoriIds'));
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:pertanyaan,kode,' . $pertanyaan->id,
            'pertanyaan' => 'required|string',
            'tipe' => 'required|string|max:20',
            'urutan' => 'required|integer',
            'aktif' => 'required|boolean',
            'kategori_ids' => 'required|array',
            'kategori_ids.*' => 'exists:kategori_framework,id',
        ]);

        $pertanyaan->update([
            'kode' => $request->kode,
            'pertanyaan' => $request->pertanyaan,
            'tipe' => $request->tipe,
            'urutan' => $request->urutan,
            'aktif' => $request->aktif,
        ]);

        $pertanyaan->kategoriFrameworks()->sync($request->kategori_ids);

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
