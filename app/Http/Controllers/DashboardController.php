<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use App\Models\DiagnosisHistory;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGejala = Gejala::count();
        $totalPenyakit = Penyakit::count();
        $totalRule = Rule::count();
        $totalDiagnosis = DiagnosisHistory::count();
        
        $recentDiagnoses = DiagnosisHistory::with('penyakit')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('dashboard.index', compact(
            'totalGejala', 
            'totalPenyakit', 
            'totalRule', 
            'totalDiagnosis',
            'recentDiagnoses'
        ));
    }
}
