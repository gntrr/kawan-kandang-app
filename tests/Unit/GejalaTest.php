<?php

namespace Tests\Unit;

use App\Models\Gejala;
use App\Models\Rule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class GejalaTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_gejala()
    {
        $gejalaData = [
            'kode_gejala' => 'G001',
            'nama_gejala' => 'Nafsu makan berkurang'
        ];

        $gejala = Gejala::create($gejalaData);

        $this->assertInstanceOf(Gejala::class, $gejala);
        $this->assertEquals('G001', $gejala->kode_gejala);
        $this->assertEquals('Nafsu makan berkurang', $gejala->nama_gejala);
    }

    #[Test]
    public function it_has_fillable_attributes()
    {
        $gejala = new Gejala();
        $fillable = $gejala->getFillable();

        $this->assertEquals(['kode_gejala', 'nama_gejala'], $fillable);
    }

    #[Test]
    public function it_uses_correct_table_name_and_primary_key()
    {
        $gejala = new Gejala();

        $this->assertEquals('gejala', $gejala->getTable());
        $this->assertEquals('id_gejala', $gejala->getKeyName());
    }

    #[Test]
    public function it_has_rules_relationship()
    {
        // Since we're testing the relationship method exists and functions correctly,
        // we can skip the actual database operation and just test the relationship definition
        $gejala = new Gejala();
        $relation = $gejala->rules();
        
        // Test that the relationship is defined correctly
        $this->assertEquals('rule_gejala', $relation->getTable());
        $this->assertEquals('gejala_id', $relation->getForeignPivotKeyName());
        $this->assertEquals('rule_id', $relation->getRelatedPivotKeyName());
    }
}