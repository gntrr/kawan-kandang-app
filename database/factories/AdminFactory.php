<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'username' => $this->faker->unique()->userName(),
            'password' => bcrypt('password'), // default password for testing
            'remember_token' => Str::random(10),
        ];
    }
}
