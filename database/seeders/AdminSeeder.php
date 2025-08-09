<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'nama' => 'Administrator',
            'alamat' => 'Jl. Admin No. 1',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}
