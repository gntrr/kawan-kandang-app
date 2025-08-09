<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use PHPUnit\Framework\Attributes\Test;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function dapat_menampilkan_halaman_login()
    {
        $response = $this->get(route('login'));
        
        $response->assertStatus(200)
                ->assertSee('Login')
                ->assertSee('Username')
                ->assertSee('Password');
    }

    #[Test]
    public function dapat_login_dengan_kredensial_valid()
    {
        // Buat admin terlebih dahulu
        $admin = Admin::create([
            'nama' => 'Admin Test',
            'alamat' => 'Jl. Admin No. 1',
            'username' => 'admintest',
            'password' => bcrypt('password')
        ]);
        
        $response = $this->post(route('login.post'), [
            'username' => 'admintest',
            'password' => 'password'
        ]);
        
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    #[Test]
    public function tidak_dapat_login_dengan_kredensial_salah()
    {
        // Buat admin terlebih dahulu
        Admin::create([
            'nama' => 'Admin Test',
            'alamat' => 'Jl. Admin No. 1',
            'username' => 'admintest',
            'password' => bcrypt('password')
        ]);
        
        $response = $this->post(route('login.post'), [
            'username' => 'admintest',
            'password' => 'password_salah'
        ]);
        
        $response->assertRedirect()
                ->assertSessionHasErrors('username');
        $this->assertGuest('admin');
    }

    #[Test]
    public function tidak_dapat_login_tanpa_input_wajib()
    {
        $response = $this->post(route('login.post'), [
            'username' => '',
            'password' => ''
        ]);
        
        $response->assertSessionHasErrors(['username', 'password']);
    }

    #[Test]
    public function dapat_logout()
    {
        // Buat admin dan login
        $admin = Admin::create([
            'nama' => 'Admin Test',
            'alamat' => 'Jl. Admin No. 1',
            'username' => 'admintest',
            'password' => bcrypt('password')
        ]);
        $this->actingAs($admin, 'admin');
        
        $response = $this->post(route('logout'));
        
        $response->assertRedirect(route('login'));
        $this->assertGuest('admin');
    }
}