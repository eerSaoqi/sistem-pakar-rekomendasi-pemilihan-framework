<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisProyek;
use App\Models\KategoriFramework;
use Illuminate\Http\Request;

class JenisProyekController extends Controller
{
    public function index()
    {
        $jenisProyeks = JenisProyek::with('kategoriFrameworks')->latest()->paginate(10);
        return view('admin.jenis_proyek.index', compact('jenisProyeks'));
    }

    public function create()
    {
        $kategoris = KategoriFramework::all();
        return view('admin.jenis_proyek.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:jenis_proyek',
            'nama' => 'required|string|max:100',
            'kategori_ids' => 'required|array',
            'kategori_ids.*' => 'exists:kategori_framework,id',
        ]);

        $jp = JenisProyek::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        $jp->kategoriFrameworks()->sync($request->kategori_ids);

        return redirect()->route('admin.jenis_proyek.index')
            ->with('success', 'Jenis Proyek berhasil ditambahkan.');
    }

    public function edit(JenisProyek $jenisProyek)
    {
        $kategoris = KategoriFramework::all();
        $selectedKategoriIds = $jenisProyek->kategoriFrameworks->pluck('id')->toArray();
        return view('admin.jenis_proyek.edit', compact('jenisProyek', 'kategoris', 'selectedKategoriIds'));
    }

    public function update(Request $request, JenisProyek $jenisProyek)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:jenis_proyek,kode,' . $jenisProyek->id,
            'nama' => 'required|string|max:100',
            'kategori_ids' => 'required|array',
            'kategori_ids.*' => 'exists:kategori_framework,id',
        ]);

        $jenisProyek->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        $jenisProyek->kategoriFrameworks()->sync($request->kategori_ids);

        return redirect()->route('admin.jenis_proyek.index')
            ->with('success', 'Jenis Proyek berhasil diperbarui.');
    }

    public function destroy(JenisProyek $jenisProyek)
    {
        $jenisProyek->delete();
        return redirect()->route('admin.jenis_proyek.index')
            ->with('success', 'Jenis Proyek berhasil dihapus.');
    }
}
