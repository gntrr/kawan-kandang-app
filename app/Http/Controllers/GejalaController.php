<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gejalas = Gejala::orderBy('kode_gejala')->paginate(10);
        return view('gejala.index', compact('gejalas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gejala.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_gejala' => 'required|string|max:6|unique:gejala',
            'nama_gejala' => 'required|string|max:70',
        ]);
        
        Gejala::create($validated);
        
        return redirect()->route('gejala.index')
            ->with('success', 'Gejala berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gejala = Gejala::findOrFail($id);
        return view('gejala.show', compact('gejala'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gejala = Gejala::findOrFail($id);
        return view('gejala.edit', compact('gejala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gejala = Gejala::findOrFail($id);
        
        $validated = $request->validate([
            'kode_gejala' => 'required|string|max:6|unique:gejala,kode_gejala,'.$id.',id_gejala',
            'nama_gejala' => 'required|string|max:70',
        ]);
        
        $gejala->update($validated);
        
        return redirect()->route('gejala.index')
            ->with('success', 'Gejala berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gejala = Gejala::findOrFail($id);
        $gejala->delete();
        
        return redirect()->route('gejala.index')
            ->with('success', 'Gejala berhasil dihapus');
    }
}
