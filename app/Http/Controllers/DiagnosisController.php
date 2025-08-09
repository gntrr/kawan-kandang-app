<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use App\Models\DiagnosisHistory;
use Carbon\Carbon;

class DiagnosisController extends Controller
{
    public function index()
    {
        $gejalas = Gejala::orderBy('kode_gejala')->get();
        return view('diagnosis.index', compact('gejalas'));
    }
    
    public function proses(Request $request)
    {
        $request->validate([
            'gejala_ids' => 'required|array|min:1',
        ]);
        
        $selectedGejalaIds = $request->input('gejala_ids');
        $selectedGejalas = Gejala::whereIn('id_gejala', $selectedGejalaIds)->get();
        
        // Ambil kode gejala yang dipilih
        $selectedGejalaKodes = $selectedGejalas->pluck('kode_gejala')->toArray();
        
        // Ambil semua rule
        $rules = Rule::with('penyakit')->get();
        
        // Simpan informasi rule matching untuk analisis
        $ruleMatching = [];
        $perfectMatches = [];
        $bestMatch = null;
        $bestMatchScore = 0;
        $bestMatchPercentage = 0;
        
        // Implementasi Forward Chaining dengan strict matching
        foreach ($rules as $rule) {
            $ruleGejalas = explode(' AND ', $rule->if_condition);
            
            // Hitung jumlah gejala rule yang cocok
            $matchedGejala = array_intersect($ruleGejalas, $selectedGejalaKodes);
            $matchCount = count($matchedGejala);
            $totalRuleGejala = count($ruleGejalas);
            
            // Hitung persentase kesesuaian
            $matchPercentage = ($totalRuleGejala > 0) ? ($matchCount / $totalRuleGejala) * 100 : 0;
            
            // Simpan informasi matching rule
            $ruleMatching[$rule->kode_rule] = [
                'rule' => $rule,
                'matched' => $matchedGejala,
                'missing' => array_diff($ruleGejalas, $selectedGejalaKodes),
                'matchCount' => $matchCount,
                'totalGejala' => $totalRuleGejala,
                'percentage' => $matchPercentage
            ];
            
            // Jika 100% cocok, simpan sebagai perfect match
            if ($matchPercentage == 100) {
                $perfectMatches[] = $rule;
                if (!$bestMatch || $matchCount > $bestMatchScore) {
                    $bestMatch = $rule;
                    $bestMatchScore = $matchCount;
                    $bestMatchPercentage = $matchPercentage;
                }
            }
            
            // Update rule dengan skor tertinggi untuk referensi
            if ($matchPercentage > $bestMatchPercentage || 
                ($matchPercentage == $bestMatchPercentage && $matchCount > $bestMatchScore)) {
                if (!$bestMatch || $matchPercentage == 100) {
                    $bestMatch = $rule;
                    $bestMatchScore = $matchCount;
                    $bestMatchPercentage = $matchPercentage;
                }
            }
        }
        
        // STRICT VALIDATION: Tolak jika tidak ada rule yang 100% cocok
        if (empty($perfectMatches)) {
            // Ambil rule dengan persentase tertinggi untuk analisis
            uasort($ruleMatching, function($a, $b) {
                return $b['percentage'] - $a['percentage'];
            });
            
            $topRules = array_slice($ruleMatching, 0, 3, true);
            
            return view('diagnosis.hasil', compact(
                'selectedGejalas',
                'bestMatchPercentage'
            ))->with([
                'hasilPenyakit' => null,
                'keyakinan' => 0,
                'noPerfectMatch' => true,
                'bestMatch' => null,
                'relevantRuleMatching' => $topRules,
                'analisisDominant' => []
            ]);
        }
        
        // Hasil Penyakit dan Tingkat Keyakinan (hanya untuk perfect match)
        $hasilPenyakit = $bestMatch->penyakit;
        $keyakinan = 100;
        
        // Simpan rule matching yang paling relevan untuk ditampilkan
        $relevantRuleMatching = [];
        
        // Tampilkan semua perfect matches
        foreach ($perfectMatches as $perfectRule) {
            $relevantRuleMatching[$perfectRule->kode_rule] = $ruleMatching[$perfectRule->kode_rule];
        }
        
        // Jika hanya ada satu perfect match, tambahkan beberapa rule teratas untuk perbandingan
        if (count($relevantRuleMatching) == 1) {
            uasort($ruleMatching, function($a, $b) {
                return $b['percentage'] - $a['percentage'];
            });
            
            $counter = 0;
            foreach ($ruleMatching as $code => $data) {
                if (!isset($relevantRuleMatching[$code]) && $data['percentage'] < 100) {
                    $relevantRuleMatching[$code] = $data;
                    $counter++;
                    if ($counter >= 2) break;
                }
            }
        }
        
        // Simpan hasil diagnosis (hanya untuk perfect match)
        $diagnosis = DiagnosisHistory::create([
            'gejala_dipilih' => json_encode($selectedGejalaKodes),
            'hasil_penyakit' => $hasilPenyakit->kode_penyakit,
            'solusi' => $hasilPenyakit->solusi,
            'tanggal_diagnosis' => Carbon::now()->toDateString(),
        ]);
        
        return view('diagnosis.hasil', compact(
            'selectedGejalas',
            'hasilPenyakit',
            'keyakinan',
            'relevantRuleMatching',
            'bestMatchPercentage',
            'bestMatch'
        ))->with([
            'noPerfectMatch' => false,
            'analisisDominant' => []
        ]);
    }
    
    public function riwayat()
    {
        $riwayats = DiagnosisHistory::with('penyakit')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('diagnosis.riwayat', compact('riwayats'));
    }
    
    public function detailRiwayat($id)
    {
        $riwayat = DiagnosisHistory::with('penyakit')->findOrFail($id);
        $gejalaKodes = json_decode($riwayat->gejala_dipilih, true);
        $gejalas = Gejala::whereIn('kode_gejala', $gejalaKodes)->get();
        
        return view('diagnosis.detail-riwayat', compact('riwayat', 'gejalas'));
    }
}
