<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Gejala;
use App\Models\Penyakit;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rules = Rule::with('penyakit')->orderBy('kode_rule')->paginate(10);
        return view('rule.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gejalas = Gejala::orderBy('kode_gejala')->get();
        $penyakits = Penyakit::orderBy('kode_penyakit')->get();
        return view('rule.create', compact('gejalas', 'penyakits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_rule' => 'required|string|max:6|unique:rules',
            'nama_rule' => 'nullable|string|max:30',
            'gejala_ids' => 'required|array|min:1',
            'then_condition' => 'required|string|exists:penyakit,kode_penyakit',
        ]);
        
        // Format if_condition dari array gejala_ids
        $gejalaKodes = Gejala::whereIn('id_gejala', $validated['gejala_ids'])
            ->pluck('kode_gejala')
            ->toArray();
            
        $if_condition = implode(' AND ', $gejalaKodes);
        
        Rule::create([
            'kode_rule' => $validated['kode_rule'],
            'nama_rule' => $validated['nama_rule'],
            'if_condition' => $if_condition,
            'then_condition' => $validated['then_condition'],
        ]);
        
        return redirect()->route('rule.index')
            ->with('success', 'Rule berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rule = Rule::with('penyakit')->findOrFail($id);
        return view('rule.show', compact('rule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rule = Rule::findOrFail($id);
        $gejalas = Gejala::orderBy('kode_gejala')->get();
        $penyakits = Penyakit::orderBy('kode_penyakit')->get();
        
        // Ambil kode gejala dari if_condition
        $selectedGejalas = explode(' AND ', $rule->if_condition);
        
        return view('rule.edit', compact('rule', 'gejalas', 'penyakits', 'selectedGejalas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rule = Rule::findOrFail($id);
        
        $validated = $request->validate([
            'kode_rule' => 'required|string|max:6|unique:rules,kode_rule,'.$id.',id_rule',
            'nama_rule' => 'nullable|string|max:30',
            'gejala_ids' => 'required|array|min:1',
            'then_condition' => 'required|string|exists:penyakit,kode_penyakit',
        ]);
        
        // Format if_condition dari array gejala_ids
        $gejalaKodes = Gejala::whereIn('id_gejala', $validated['gejala_ids'])
            ->pluck('kode_gejala')
            ->toArray();
            
        $if_condition = implode(' AND ', $gejalaKodes);
        
        $rule->update([
            'kode_rule' => $validated['kode_rule'],
            'nama_rule' => $validated['nama_rule'],
            'if_condition' => $if_condition,
            'then_condition' => $validated['then_condition'],
        ]);
        
        return redirect()->route('rule.index')
            ->with('success', 'Rule berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rule = Rule::findOrFail($id);
        $rule->delete();
        
        return redirect()->route('rule.index')
            ->with('success', 'Rule berhasil dihapus');
    }
}
