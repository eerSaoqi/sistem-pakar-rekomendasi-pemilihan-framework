<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriFramework;
use Illuminate\Http\Request;

class KategoriFrameworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = KategoriFramework::latest()->paginate(10);
        return view('admin.kategori_framework.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori_framework.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:kategori_framework',
            'nama' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriFramework::create($request->all());

        return redirect()->route('admin.kategori_framework.index')
            ->with('success', 'Kategori Framework berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriFramework $kategoriFramework)
    {
        return view('admin.kategori_framework.show', compact('kategoriFramework'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriFramework $kategoriFramework)
    {
        return view('admin.kategori_framework.edit', compact('kategoriFramework'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriFramework $kategoriFramework)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:kategori_framework,kode,' . $kategoriFramework->id,
            'nama' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriFramework->update($request->all());

        return redirect()->route('admin.kategori_framework.index')
            ->with('success', 'Kategori Framework berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriFramework $kategoriFramework)
    {
        $kategoriFramework->delete();

        return redirect()->route('admin.kategori_framework.index')
            ->with('success', 'Kategori Framework berhasil dihapus.');
    }
}
