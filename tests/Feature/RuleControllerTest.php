<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use PHPUnit\Framework\Attributes\Test;

class RuleControllerTest extends TestCase
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
        
        // Seed dengan data gejala dan penyakit dari seeder
        $this->seed(\Database\Seeders\GejalaSeeder::class);
        $this->seed(\Database\Seeders\PenyakitSeeder::class);
        $this->seed(\Database\Seeders\RuleSeeder::class);
    }

    #[Test]
    public function dapat_menampilkan_daftar_rule()
    {
        $response = $this->get(route('rule.index'));
        
        $response->assertStatus(200)
                ->assertSee('R1')
                ->assertSee('R2')
                ->assertViewHas('rules');
    }

    #[Test]
    public function dapat_menampilkan_halaman_tambah_rule()
    {
        $response = $this->get(route('rule.create'));
        
        $response->assertStatus(200)
                ->assertSee('Tambah Rule')
                ->assertViewHas(['gejalas', 'penyakits']);
    }

    #[Test]
    public function dapat_menyimpan_rule_baru()
    {
        // Ambil beberapa ID gejala
        $gejalaIds = Gejala::take(3)->pluck('id_gejala')->toArray();
        $kodePenyakit = Penyakit::first()->kode_penyakit;
        
        $data = [
            'kode_rule' => 'R999',
            'nama_rule' => 'Rule Test',
            'gejala_ids' => $gejalaIds,
            'then_condition' => $kodePenyakit
        ];
        
        $response = $this->post(route('rule.store'), $data);
        
        $response->assertRedirect(route('rule.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseHas('rules', [
            'kode_rule' => 'R999',
            'nama_rule' => 'Rule Test'
        ]);
    }

    #[Test]
    public function tidak_dapat_menyimpan_rule_tanpa_data_wajib()
    {
        $response = $this->post(route('rule.store'), [
            'kode_rule' => '',
            'nama_rule' => 'Rule Test',
            'gejala_ids' => [],
            'then_condition' => ''
        ]);
        
        $response->assertSessionHasErrors(['kode_rule', 'gejala_ids', 'then_condition']);
    }

    #[Test]
    public function tidak_dapat_menyimpan_rule_dengan_kode_duplikat()
    {
        // R1 sudah ada dari seeder
        $gejalaIds = Gejala::take(3)->pluck('id_gejala')->toArray();
        $kodePenyakit = Penyakit::first()->kode_penyakit;
        
        $response = $this->post(route('rule.store'), [
            'kode_rule' => 'R1',
            'nama_rule' => 'Rule Test Duplikat',
            'gejala_ids' => $gejalaIds,
            'then_condition' => $kodePenyakit
        ]);
        
        $response->assertSessionHasErrors('kode_rule');
    }

    #[Test]
    public function dapat_menampilkan_detail_rule()
    {
        $rule = Rule::where('kode_rule', 'R1')->first();
        
        $response = $this->get(route('rule.show', $rule->id_rule));
        
        $response->assertStatus(200)
                ->assertSee('R1')
                ->assertViewHas('rule');
    }

    #[Test]
    public function dapat_menampilkan_halaman_edit_rule()
    {
        $rule = Rule::where('kode_rule', 'R1')->first();
        
        $response = $this->get(route('rule.edit', $rule->id_rule));
        
        $response->assertStatus(200)
                ->assertSee('Edit Rule')
                ->assertSee('R1')
                ->assertViewHas(['rule', 'gejalas', 'penyakits', 'selectedGejalas']);
    }

    #[Test]
    public function dapat_memperbarui_rule()
    {
        $rule = Rule::where('kode_rule', 'R1')->first();
        
        // Ambil beberapa ID gejala
        $gejalaIds = Gejala::take(4)->pluck('id_gejala')->toArray();
        $kodePenyakit = Penyakit::first()->kode_penyakit;
        
        $data = [
            'kode_rule' => 'R1',
            'nama_rule' => 'Rule 1 Updated',
            'gejala_ids' => $gejalaIds,
            'then_condition' => $kodePenyakit
        ];
        
        $response = $this->put(route('rule.update', $rule->id_rule), $data);
        
        $response->assertRedirect(route('rule.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseHas('rules', [
            'kode_rule' => 'R1',
            'nama_rule' => 'Rule 1 Updated'
        ]);
    }

    #[Test]
    public function tidak_dapat_update_dengan_kode_duplikat()
    {
        $rule = Rule::where('kode_rule', 'R2')->first();
        
        // Ambil beberapa ID gejala
        $gejalaIds = Gejala::take(3)->pluck('id_gejala')->toArray();
        $kodePenyakit = Penyakit::first()->kode_penyakit;
        
        // Coba update R2 menjadi R1 yang sudah ada
        $response = $this->put(route('rule.update', $rule->id_rule), [
            'kode_rule' => 'R1',
            'nama_rule' => 'Rule Test Update',
            'gejala_ids' => $gejalaIds,
            'then_condition' => $kodePenyakit
        ]);
        
        $response->assertSessionHasErrors('kode_rule');
    }

    #[Test]
    public function dapat_menghapus_rule()
    {
        $rule = Rule::where('kode_rule', 'R15')->first();
        
        $response = $this->delete(route('rule.destroy', $rule->id_rule));
        
        $response->assertRedirect(route('rule.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseMissing('rules', ['kode_rule' => 'R15']);
    }
    
    #[Test]
    public function tidak_dapat_mengakses_rule_tanpa_autentikasi()
    {
        auth()->logout();
        
        $response = $this->get(route('rule.index'));
        
        $response->assertRedirect(route('login'));
    }
}