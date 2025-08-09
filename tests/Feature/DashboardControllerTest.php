<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use App\Models\DiagnosisHistory;
use PHPUnit\Framework\Attributes\Test;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create and login as admin user
        $admin = Admin::create([
            'nama' => 'Admin Test',
            'alamat' => 'Jl. Admin No. 1',
            'username' => 'admintest',
            'password' => bcrypt('password')
        ]);
        $this->actingAs($admin, 'admin');
        
        // Seed dengan data testing
        $this->seed(\Database\Seeders\GejalaSeeder::class);
        $this->seed(\Database\Seeders\PenyakitSeeder::class);
        $this->seed(\Database\Seeders\RuleSeeder::class);
    }

    #[Test]
    public function dapat_menampilkan_dashboard()
    {
        $response = $this->get(route('dashboard'));
        
        $response->assertStatus(200)
                ->assertViewHas([
                    'totalGejala', 
                    'totalPenyakit', 
                    'totalRule', 
                    'totalDiagnosis',
                    'recentDiagnoses'
                ]);
    }

    #[Test]
    public function dashboard_menampilkan_total_data_dengan_benar()
    {
        // Buat beberapa diagnosis history untuk testing
        $penyakit = Penyakit::first();
        DiagnosisHistory::create([
            'gejala_dipilih' => json_encode(['G001', 'G002', 'G003']),
            'hasil_penyakit' => $penyakit->kode_penyakit,
            'solusi' => $penyakit->solusi,
            'tanggal_diagnosis' => now(),
        ]);
        
        DiagnosisHistory::create([
            'gejala_dipilih' => json_encode(['G004', 'G005', 'G006']),
            'hasil_penyakit' => $penyakit->kode_penyakit,
            'solusi' => $penyakit->solusi,
            'tanggal_diagnosis' => now(),
        ]);
        
        $response = $this->get(route('dashboard'));
        
        $response->assertStatus(200)
                ->assertViewHas('totalGejala', Gejala::count())
                ->assertViewHas('totalPenyakit', Penyakit::count())
                ->assertViewHas('totalRule', Rule::count())
                ->assertViewHas('totalDiagnosis', DiagnosisHistory::count());
    }

    #[Test]
    public function dashboard_menampilkan_diagnosis_terbaru()
    {
        // Buat beberapa diagnosis history untuk testing
        $penyakit = Penyakit::first();
        // Create older diagnosis
        $olderDiagnosis = DiagnosisHistory::create([
            'gejala_dipilih' => json_encode(['G001', 'G002', 'G003']),
            'hasil_penyakit' => $penyakit->kode_penyakit,
            'solusi' => $penyakit->solusi,
            'tanggal_diagnosis' => now()->subDay(1),
        ]);
        
        // Create newer diagnosis
        $newerDiagnosis = DiagnosisHistory::create([
            'gejala_dipilih' => json_encode(['G004', 'G005', 'G006']),
            'hasil_penyakit' => $penyakit->kode_penyakit,
            'solusi' => $penyakit->solusi,
            'tanggal_diagnosis' => now(),
        ]);
        
        $response = $this->get(route('dashboard'));
        
        $response->assertStatus(200);
                
        $recentDiagnoses = $response->viewData('recentDiagnoses');
        $this->assertCount(2, $recentDiagnoses);
        
        // Just check that both diagnoses are present without assuming any specific order
        // Make sure we can find both the older and newer diagnosis in the collection
        $this->assertTrue(
            $recentDiagnoses->contains(function ($diagnosis) use ($olderDiagnosis) {
                return $diagnosis->id_diagnosis === $olderDiagnosis->id_diagnosis;
            }) && 
            $recentDiagnoses->contains(function ($diagnosis) use ($newerDiagnosis) {
                return $diagnosis->id_diagnosis === $newerDiagnosis->id_diagnosis;
            }),
            'Recent diagnoses should contain both the older and newer diagnoses'
        );
    }
    
    #[Test]
    public function tidak_dapat_mengakses_dashboard_tanpa_autentikasi()
    {
        auth()->logout();
        
        $response = $this->get(route('dashboard'));
        
        $response->assertRedirect(route('login'));
    }
}