<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Penyakit;
use PHPUnit\Framework\Attributes\Test;

class PenyakitControllerTest extends TestCase
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
        
        // Seed dengan data penyakit dari seeder
        $this->seed(\Database\Seeders\PenyakitSeeder::class);
    }

    #[Test]
    public function dapat_menampilkan_daftar_penyakit()
    {
        $response = $this->get(route('penyakit.index'));
        
        $response->assertStatus(200)
                ->assertSee('Berak Kapur (Pullorum Disease)')
                ->assertSee('Kolera Ayam (Fowl Cholera)')
                ->assertViewHas('penyakits');
    }

    #[Test]
    public function dapat_menampilkan_halaman_tambah_penyakit()
    {
        $response = $this->get(route('penyakit.create'));
        
        $response->assertStatus(200)
                ->assertSee('Tambah Penyakit');
    }

    #[Test]
    public function dapat_menyimpan_penyakit_baru()
    {
        $data = [
            'kode_penyakit' => 'P999',
            'nama_penyakit' => 'Penyakit Test Baru',
            'solusi' => 'Solusi untuk penyakit test'
        ];
        
        $response = $this->post(route('penyakit.store'), $data);
        
        $response->assertRedirect(route('penyakit.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseHas('penyakit', $data);
    }

    #[Test]
    public function tidak_dapat_menyimpan_penyakit_tanpa_data_wajib()
    {
        $response = $this->post(route('penyakit.store'), [
            'kode_penyakit' => '',
            'nama_penyakit' => ''
        ]);
        
        $response->assertSessionHasErrors(['kode_penyakit', 'nama_penyakit']);
    }

    #[Test]
    public function tidak_dapat_menyimpan_penyakit_dengan_kode_duplikat()
    {
        // P001 sudah ada dari seeder
        $response = $this->post(route('penyakit.store'), [
            'kode_penyakit' => 'P001',
            'nama_penyakit' => 'Penyakit Test Duplikat',
            'solusi' => 'Solusi test'
        ]);
        
        $response->assertSessionHasErrors('kode_penyakit');
    }

    #[Test]
    public function dapat_menampilkan_detail_penyakit()
    {
        $penyakit = Penyakit::where('kode_penyakit', 'P001')->first();
        
        $response = $this->get(route('penyakit.show', $penyakit->id_penyakit));
        
        $response->assertStatus(200)
                ->assertSee('Berak Kapur (Pullorum Disease)')
                ->assertSee('Dosis Master Coliprim')
                ->assertViewHas('penyakit');
    }

    #[Test]
    public function dapat_menampilkan_halaman_edit_penyakit()
    {
        $penyakit = Penyakit::where('kode_penyakit', 'P001')->first();
        
        $response = $this->get(route('penyakit.edit', $penyakit->id_penyakit));
        
        $response->assertStatus(200)
                ->assertSee('Edit Penyakit')
                ->assertSee('P001')
                ->assertSee('Berak Kapur (Pullorum Disease)')
                ->assertViewHas('penyakit');
    }

    #[Test]
    public function dapat_memperbarui_penyakit()
    {
        $penyakit = Penyakit::where('kode_penyakit', 'P001')->first();
        
        $data = [
            'kode_penyakit' => 'P001',
            'nama_penyakit' => 'Berak Kapur (Updated)',
            'solusi' => 'Solusi baru untuk berak kapur'
        ];
        
        $response = $this->put(route('penyakit.update', $penyakit->id_penyakit), $data);
        
        $response->assertRedirect(route('penyakit.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseHas('penyakit', $data);
    }

    #[Test]
    public function tidak_dapat_update_dengan_kode_duplikat()
    {
        $penyakit = Penyakit::where('kode_penyakit', 'P002')->first();
        
        // Coba update P002 menjadi P001 yang sudah ada
        $response = $this->put(route('penyakit.update', $penyakit->id_penyakit), [
            'kode_penyakit' => 'P001',
            'nama_penyakit' => 'Penyakit Test Update',
            'solusi' => 'Solusi test update'
        ]);
        
        $response->assertSessionHasErrors('kode_penyakit');
    }

    #[Test]
    public function dapat_menghapus_penyakit()
    {
        $penyakit = Penyakit::where('kode_penyakit', 'P015')->first(); // Ambil penyakit terakhir dari seeder
        
        $response = $this->delete(route('penyakit.destroy', $penyakit->id_penyakit));
        
        $response->assertRedirect(route('penyakit.index'))
                ->assertSessionHas('success');
                
        $this->assertDatabaseMissing('penyakit', ['kode_penyakit' => 'P015']);
    }
    
    #[Test]
    public function tidak_dapat_mengakses_penyakit_tanpa_autentikasi()
    {
        auth()->logout();
        
        $response = $this->get(route('penyakit.index'));
        
        $response->assertRedirect(route('login'));
    }
}