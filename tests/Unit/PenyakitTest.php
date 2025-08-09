<?php

namespace Tests\Unit;

use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PenyakitTest extends TestCase
{
    use RefreshDatabase;
    
    #[Test]
    public function it_can_create_penyakit()
    {
        $penyakitData = [
            'kode_penyakit' => 'P001',
            'nama_penyakit' => 'Avian Influenza',
            'solusi' => 'Isolasi dan pengobatan segera dengan antibiotik'
        ];

        $penyakit = Penyakit::create($penyakitData);

        $this->assertInstanceOf(Penyakit::class, $penyakit);
        $this->assertEquals('P001', $penyakit->kode_penyakit);
        $this->assertEquals('Avian Influenza', $penyakit->nama_penyakit);
        $this->assertEquals('Isolasi dan pengobatan segera dengan antibiotik', $penyakit->solusi);
    }

    #[Test]
    public function it_has_fillable_attributes()
    {
        $penyakit = new Penyakit();
        $fillable = $penyakit->getFillable();

        $this->assertEquals(['kode_penyakit', 'nama_penyakit', 'solusi'], $fillable);
    }

    #[Test]
    public function it_uses_correct_table_name_and_primary_key()
    {
        $penyakit = new Penyakit();
        
        $this->assertEquals('penyakit', $penyakit->getTable());
        $this->assertEquals('id_penyakit', $penyakit->getKeyName());
    }

    #[Test]
    public function it_has_rules_relationship()
    {
        $penyakit = Penyakit::factory()->create([
            'kode_penyakit' => 'P002',
            'nama_penyakit' => 'Newcastle Disease',
            'solusi' => 'Vaksinasi dan pengobatan suportif'
        ]);

        // Create a rule that references this penyakit
        $rule = Rule::factory()->create([
            'then_condition' => 'P002' // Using the penyakit kode
        ]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $penyakit->rules);
        $this->assertTrue($penyakit->rules->contains($rule));
    }
}