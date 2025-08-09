<?php

namespace Tests\Unit;

use App\Models\DiagnosisHistory;
use App\Models\Penyakit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DiagnosisHistoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_diagnosis_history()
    {
        $diagnosisData = [
            'gejala_dipilih' => json_encode(['G001', 'G002', 'G003']),
            'hasil_penyakit' => 'P001',
            'solusi' => 'Isolasi dan pengobatan dengan antibiotik',
            'tanggal_diagnosis' => now(),
        ];

        $diagnosis = DiagnosisHistory::create($diagnosisData);

        $this->assertInstanceOf(DiagnosisHistory::class, $diagnosis);
        $this->assertEquals(json_encode(['G001', 'G002', 'G003']), $diagnosis->gejala_dipilih);
        $this->assertEquals('P001', $diagnosis->hasil_penyakit);
        $this->assertEquals('Isolasi dan pengobatan dengan antibiotik', $diagnosis->solusi);
    }

    #[Test]
    public function it_has_fillable_attributes()
    {
        $diagnosis = new DiagnosisHistory();
        $fillable = $diagnosis->getFillable();

        $this->assertEquals([
            'gejala_dipilih',
            'hasil_penyakit',
            'solusi',
            'tanggal_diagnosis',
        ], $fillable);
    }

    #[Test]
    public function it_uses_correct_table_name_and_primary_key()
    {
        $diagnosis = new DiagnosisHistory();
        
        $this->assertEquals('diagnosis_histories', $diagnosis->getTable());
        $this->assertEquals('id_diagnosis', $diagnosis->getKeyName());
    }

    #[Test]
    public function it_casts_date_attributes_correctly()
    {
        $diagnosis = new DiagnosisHistory();
        $casts = $diagnosis->getCasts();
        
        $this->assertArrayHasKey('tanggal_diagnosis', $casts);
        $this->assertEquals('date', $casts['tanggal_diagnosis']);
    }

    #[Test]
    public function it_has_penyakit_relationship()
    {
        // Create a penyakit first
        $penyakit = Penyakit::factory()->create([
            'kode_penyakit' => 'P003',
            'nama_penyakit' => 'Infectious Bronchitis',
            'solusi' => 'Pengobatan suportif dan vaksinasi'
        ]);

        // Create a diagnosis history that references this penyakit
        $diagnosis = DiagnosisHistory::factory()->create([
            'hasil_penyakit' => 'P003', 
            'gejala_dipilih' => json_encode(['G001', 'G005']),
            'solusi' => 'Pengobatan suportif'
        ]);

        // Test the relationship
        $this->assertInstanceOf(Penyakit::class, $diagnosis->penyakit);
        $this->assertEquals('Infectious Bronchitis', $diagnosis->penyakit->nama_penyakit);
    }

    #[Test]
    public function it_can_get_gejalas_array()
    {
        $gejalasArray = ['G001', 'G002', 'G003'];
        
        $diagnosis = DiagnosisHistory::factory()->create([
            'gejala_dipilih' => json_encode($gejalasArray)
        ]);

        $result = $diagnosis->getGejalasArray();
        
        $this->assertIsArray($result);
        $this->assertEquals($gejalasArray, $result);
    }
}