<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use PHPUnit\Framework\Attributes\Test;

class GejalaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create the Admin factory if it doesn't exist
        if (!Admin::factory()->count(0)->make()) {
            // Handle case where factory might fail
        }
        
        // Create and login as admin user - use hardcoded insert if factory fails
        try {
            $admin = Admin::factory()->create([
                'nama' => 'Admin Test',
                'alamat' => 'Jl. Admin No. 1',
                'username' => 'admintest',
                'password' => bcrypt('password')
            ]);
            $this->actingAs($admin, 'admin');
        } catch (\Throwable $e) {
            // Fallback: directly insert admin
            $admin = Admin::create([
                'nama' => 'Admin Test',
                'alamat' => 'Jl. Admin No. 1',
                'username' => 'admintest',
                'password' => bcrypt('password')
            ]);
            $this->actingAs($admin, 'admin');
        }
        
        // Seed dengan data gejala dari seeder
        $this->seed(\Database\Seeders\GejalaSeeder::class);
    }

    #[Test]
    public function dapat_menampilkan_daftar_gejala()
    {
        $response = $this->get(route('gejala.index'));
        
        $response->assertStatus(200)
                ->assertSee('Nafsu makan menurun')
                ->assertSee('Nafas penuh/ megap-megap')
                ->assertViewHas('gejalas');
    }

    #[Test]
    public function dapat_menampilkan_halaman_tambah_gejala()
    {
        $response = $this->get(route('gejala.create'));
        
        $response->assertStatus(200)
                ->assertSee('Tambah Gejala');
    }

    #[Test]
    public function dapat_menyimpan_gejala_baru()
    {
        $data = [
            'kode_gejala' => 'G999',
            'nama_gejala' => 'Gejala Test Baru'
        ];
        
        $response = $this->post(route('gejala.store'), $data);
        
        $response->assertRedirect(route('gejala.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseHas('gejala', $data);
    }

    #[Test]
    public function tidak_dapat_menyimpan_gejala_tanpa_data_wajib()
    {
        $response = $this->post(route('gejala.store'), [
            'kode_gejala' => '',
            'nama_gejala' => ''
        ]);
        
        $response->assertSessionHasErrors(['kode_gejala', 'nama_gejala']);
    }

    #[Test]
    public function tidak_dapat_menyimpan_gejala_dengan_kode_duplikat()
    {
        // G001 sudah ada dari seeder
        $response = $this->post(route('gejala.store'), [
            'kode_gejala' => 'G001',
            'nama_gejala' => 'Gejala Test Duplikat'
        ]);
        
        $response->assertSessionHasErrors('kode_gejala');
    }

    #[Test]
    public function dapat_menampilkan_halaman_edit_gejala()
    {
        $gejala = Gejala::where('kode_gejala', 'G001')->first();
        
        $response = $this->get(route('gejala.edit', $gejala->id_gejala));
        
        $response->assertStatus(200)
                ->assertSee('G001')
                ->assertSee('Nafsu makan menurun')
                ->assertViewHas('gejala');
    }

    #[Test]
    public function dapat_memperbarui_gejala()
    {
        $gejala = Gejala::where('kode_gejala', 'G001')->first();
        
        $data = [
            'kode_gejala' => 'G001',
            'nama_gejala' => 'Nafsu makan sangat menurun'
        ];
        
        $response = $this->put(route('gejala.update', $gejala->id_gejala), $data);
        
        $response->assertRedirect(route('gejala.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseHas('gejala', $data);
    }

    #[Test]
    public function tidak_dapat_update_dengan_kode_duplikat()
    {
        $gejala = Gejala::where('kode_gejala', 'G002')->first();
        
        // Coba update G002 menjadi G001 yang sudah ada
        $response = $this->put(route('gejala.update', $gejala->id_gejala), [
            'kode_gejala' => 'G001',
            'nama_gejala' => 'Gejala Test Update'
        ]);
        
        $response->assertSessionHasErrors('kode_gejala');
    }

    #[Test]
    public function dapat_menghapus_gejala()
    {
        $gejala = Gejala::where('kode_gejala', 'G044')->first(); // Ambil gejala terakhir dari seeder
        
        $response = $this->delete(route('gejala.destroy', $gejala->id_gejala));
        
        $response->assertRedirect(route('gejala.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseMissing('gejala', ['kode_gejala' => 'G044']);
    }
    
    #[Test]
    public function tidak_dapat_mengakses_gejala_tanpa_autentikasi()
    {
        auth()->logout();
        
        $response = $this->get(route('gejala.index'));
        
        $response->assertRedirect(route('login'));
    }
}
