<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyakits = Penyakit::orderBy('kode_penyakit')->paginate(10);
        return view('penyakit.index', compact('penyakits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penyakit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_penyakit' => 'required|string|max:6|unique:penyakit',
            'nama_penyakit' => 'required|string|max:30',
            'solusi' => 'nullable|string',
        ]);
        
        Penyakit::create($validated);
        
        return redirect()->route('penyakit.index')
            ->with('success', 'Penyakit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penyakit = Penyakit::findOrFail($id);
        return view('penyakit.show', compact('penyakit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penyakit = Penyakit::findOrFail($id);
        return view('penyakit.edit', compact('penyakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penyakit = Penyakit::findOrFail($id);
        
        $validated = $request->validate([
            'kode_penyakit' => 'required|string|max:6|unique:penyakit,kode_penyakit,'.$id.',id_penyakit',
            'nama_penyakit' => 'required|string|max:30',
            'solusi' => 'nullable|string',
        ]);
        
        $penyakit->update($validated);
        
        return redirect()->route('penyakit.index')
            ->with('success', 'Penyakit berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->delete();
        
        return redirect()->route('penyakit.index')
            ->with('success', 'Penyakit berhasil dihapus');
    }
}
