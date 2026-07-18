<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Framework;
use App\Models\KategoriFramework;
use Illuminate\Http\Request;

class FrameworkController extends Controller
{
    public function index()
    {
        $frameworks = Framework::with('kategoriFramework')->latest()->paginate(10);
        return view('admin.framework.index', compact('frameworks'));
    }

    public function create()
    {
        $kategoris = KategoriFramework::all();
        return view('admin.framework.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_framework_id' => 'required|exists:kategori_framework,id',
            'kode' => 'required|string|max:10|unique:framework',
            'nama_framework' => 'required|string|max:50',
            'bahasa' => 'required|string|max:50',
            'website' => 'nullable|url',
            'deskripsi' => 'nullable|string',
        ]);

        Framework::create($request->all());

        return redirect()->route('admin.framework.index')
            ->with('success', 'Framework berhasil ditambahkan.');
    }

    public function edit(Framework $framework)
    {
        $kategoris = KategoriFramework::all();
        return view('admin.framework.edit', compact('framework', 'kategoris'));
    }

    public function update(Request $request, Framework $framework)
    {
        $request->validate([
            'kategori_framework_id' => 'required|exists:kategori_framework,id',
            'kode' => 'required|string|max:10|unique:framework,kode,' . $framework->id,
            'nama_framework' => 'required|string|max:50',
            'bahasa' => 'required|string|max:50',
            'website' => 'nullable|url',
            'deskripsi' => 'nullable|string',
        ]);

        $framework->update($request->all());

        return redirect()->route('admin.framework.index')
            ->with('success', 'Framework berhasil diperbarui.');
    }

    public function destroy(Framework $framework)
    {
        $framework->delete();
        return redirect()->route('admin.framework.index')
            ->with('success', 'Framework berhasil dihapus.');
    }
}
