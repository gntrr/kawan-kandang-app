<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use App\Models\DiagnosisHistory;
use PHPUnit\Framework\Attributes\Test;

class DiagnosisControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed the database with test data
        $this->seed(\Database\Seeders\GejalaSeeder::class);
        $this->seed(\Database\Seeders\PenyakitSeeder::class);
        $this->seed(\Database\Seeders\RuleSeeder::class);
    }

    #[Test]
    public function dapat_mendiagnosis_penyakit_dengan_rule_cocok_penuh()
    {
        // Rule R1: G012 AND G023 AND G024 => P001
        $gejalaIds = Gejala::whereIn('kode_gejala', ['G012', 'G023', 'G024'])->pluck('id_gejala')->toArray();
        
        $response = $this->post(route('diagnosis.proses'), [
            'gejala_ids' => $gejalaIds
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('Berak Kapur (Pullorum Disease)');
        $response->assertSee('100');  // 100% confidence
    }
    
    #[Test]
    public function dapat_mendiagnosis_penyakit_dengan_rule_cocok_sebagian()
    {
        // Partial match for Rule R2: G001 AND G003 (missing G015 AND G021)
        $gejalaIds = Gejala::whereIn('kode_gejala', ['G001', 'G003'])->pluck('id_gejala')->toArray();
        
        $response = $this->post(route('diagnosis.proses'), [
            'gejala_ids' => $gejalaIds
        ]);
        
        $response->assertStatus(200);
        $response->assertViewHas('bestMatchPercentage', function($value) {
            return $value < 100; // Should be 50% (2 out of 4)
        });
    }
    
    #[Test]
    public function dapat_mengidentifikasi_penyakit_dominan_saat_tidak_ada_rule_yang_cocok_penuh()
    {
        // Select G001 (appears in multiple rules: R2, R4, R5, R7, R9, R10, etc.)
        // and G006 (appears in R6)
        // Should favor penyakit with more matching gejala
        $gejalaIds = Gejala::whereIn('kode_gejala', ['G001', 'G006'])->pluck('id_gejala')->toArray();
        
        $response = $this->post(route('diagnosis.proses'), [
            'gejala_ids' => $gejalaIds
        ]);
        
        $response->assertStatus(200);
        $response->assertViewHas('analisisDominant');
        $response->assertViewHas('keyakinan', function($value) {
            return $value > 0 && $value < 100;
        });
    }
    
    #[Test]
    public function dapat_menangani_beberapa_kemungkinan_penyakit()
    {
        // G001 appears in many rules, testing the system's ability to rank diseases
        $gejalaIds = Gejala::whereIn('kode_gejala', ['G001', 'G005', 'G009'])->pluck('id_gejala')->toArray();
        
        $response = $this->post(route('diagnosis.proses'), [
            'gejala_ids' => $gejalaIds
        ]);
        
        $response->assertStatus(200);
        $response->assertViewHas('analisisDominant', function($value) {
            // Check if we have multiple matches in the analysis
            return count($value) > 0;
        });
    }
    
    #[Test]
    public function dapat_menyimpan_riwayat_diagnosis_dengan_benar()
    {
        // Using Rule R3: G013 AND G014 AND G019 AND G025
        $gejalaIds = Gejala::whereIn('kode_gejala', ['G013', 'G014', 'G019', 'G025'])->pluck('id_gejala')->toArray();
        
        $this->post(route('diagnosis.proses'), [
            'gejala_ids' => $gejalaIds
        ]);
        
        $penyakit = Penyakit::where('kode_penyakit', 'P003')->first();
        
        // Check if history was saved with the correct penyakit code
        $this->assertDatabaseHas('diagnosis_histories', [
            'hasil_penyakit' => $penyakit->kode_penyakit
        ]);
        
        // Verify that the selected gejala were saved
        $history = DiagnosisHistory::latest()->first();
        $savedGejala = json_decode($history->gejala_dipilih, true);
        $this->assertEqualsCanonicalizing(['G013', 'G014', 'G019', 'G025'], $savedGejala);
    }
    
    #[Test]
    public function dapat_menangani_ketika_tidak_ada_gejala_dipilih()
    {
        $response = $this->post(route('diagnosis.proses'), [
            'gejala_ids' => []
        ]);
        
        $response->assertSessionHasErrors('gejala_ids');
    }
    
    #[Test]
    public function dapat_mendiagnosis_semua_penyakit_dari_rules()
    {
        // Test for Rule R1: P001 - Berak Kapur
        $this->diagnosaDanAssertPenyakit(['G012', 'G023', 'G024'], 'P001');
        
        // Test for Rule R2: P002 - Kolera Ayam
        $this->diagnosaDanAssertPenyakit(['G001', 'G003', 'G015', 'G021'], 'P002');
        
        // Test for Rule R3: P003 - Flu Burung
        $this->diagnosaDanAssertPenyakit(['G013', 'G014', 'G019', 'G025'], 'P003');
        
        // Test for Rule R4: P004 - Tetelo
        $this->diagnosaDanAssertPenyakit(['G001', 'G002', 'G004', 'G010', 'G011', 'G020'], 'P004');
        
        // Test for Rule R5: P005 - Tipus Ayam
        $this->diagnosaDanAssertPenyakit(['G001', 'G016', 'G023', 'G028'], 'P005');
        
        // Test for Rule R6: P006 - Berak Darah
        $this->diagnosaDanAssertPenyakit(['G006', 'G009', 'G010', 'G030', 'G031'], 'P006');
        
        // Test for Rule R7: P007 - Gumboro
        $this->diagnosaDanAssertPenyakit(['G001', 'G032', 'G038', 'G039'], 'P007');
    }
    
    /**
     * Metode pembantu untuk menguji diagnosis dengan kode gejala tertentu dan memastikan penyakit yang diharapkan
     */
    private function diagnosaDanAssertPenyakit(array $gejalaCodes, string $expectedPenyakitCode)
    {
        $gejalaIds = Gejala::whereIn('kode_gejala', $gejalaCodes)->pluck('id_gejala')->toArray();
        
        $response = $this->post(route('diagnosis.proses'), [
            'gejala_ids' => $gejalaIds
        ]);
        
        $response->assertStatus(200);
        
        $penyakit = Penyakit::where('kode_penyakit', $expectedPenyakitCode)->first();
        $response->assertViewHas('hasilPenyakit', function($value) use ($penyakit) {
            return $value && $value->id_penyakit === $penyakit->id_penyakit;
        });
    }
    
    #[Test]
    public function dapat_menguji_perhitungan_kesesuaian_rule()
    {
        // Testing Rule R8: G002 AND G018 AND G029 -> P008
        // Providing 2 out of 3 symptoms should give 66.67% match
        $gejalaIds = Gejala::whereIn('kode_gejala', ['G002', 'G018'])->pluck('id_gejala')->toArray();
        
        $response = $this->post(route('diagnosis.proses'), [
            'gejala_ids' => $gejalaIds
        ]);
        
        $response->assertStatus(200);
        $response->assertViewHas('bestMatchPercentage', function($value) {
            // Due to floating point, we check if it's close to 66.67%
            return abs($value - 66.67) < 0.1;
        });
    }
    
    #[Test]
    public function dapat_menangani_rules_kompleks()
    {
        // Test one of the more complex rules (more gejala)
        // Rule R13: G007 AND G008 AND G026 AND G027 AND G033 AND G034 -> P013
        $gejalaIds = Gejala::whereIn('kode_gejala', ['G007', 'G008', 'G026', 'G027', 'G033', 'G034'])->pluck('id_gejala')->toArray();
        
        $response = $this->post(route('diagnosis.proses'), [
            'gejala_ids' => $gejalaIds
        ]);
        
        $response->assertStatus(200);
        $penyakit = Penyakit::where('kode_penyakit', 'P013')->first();
        $response->assertViewHas('hasilPenyakit', function($value) use ($penyakit) {
            return $value && $value->id_penyakit === $penyakit->id_penyakit;
        });
        $response->assertViewHas('keyakinan', 100); // 100% match
    }
}
