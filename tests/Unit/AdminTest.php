<?php

namespace Tests\Unit;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_user()
    {
        $userData = [
            'nama' => 'Test Admin',
            'alamat' => 'Jl. Test No. 1',
            'username' => 'testadmin',
            'password' => Hash::make('password123'),
        ];

        $user = Admin::create($userData);

        $this->assertInstanceOf(Admin::class, $user);
        $this->assertEquals('Test Admin', $user->nama);
        $this->assertEquals('Jl. Test No. 1', $user->alamat);
        $this->assertEquals('testadmin', $user->username);
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    #[Test]
    public function it_has_fillable_attributes()
    {
        $user = new Admin();
        $fillable = $user->getFillable();

        $this->assertEquals(['nama', 'alamat', 'username', 'password'], $fillable);
    }

    #[Test]
    public function it_hides_sensitive_attributes()
    {
        $user = Admin::factory()->create([
            'password' => Hash::make('secret'),
        ]);

        $userArray = $user->toArray();

        $this->assertArrayNotHasKey('password', $userArray);
        // $this->assertArrayNotHasKey('remember_token', $userArray);
    }

    #[Test]
    public function it_casts_attributes_correctly()
    {
        $user = new Admin();
        $casts = $user->getCasts();

        // $this->assertArrayHasKey('email_verified_at', $casts);
        // $this->assertEquals('datetime', $casts['email_verified_at']);
        $this->assertArrayHasKey('password', $casts);
        $this->assertEquals('hashed', $casts['password']);
    }
}