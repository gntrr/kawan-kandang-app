<?php

namespace Database\Factories;

use App\Models\Penyakit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penyakit>
 */
class PenyakitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penyakit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $kodeCounter = 1;
        
        return [
            'kode_penyakit' => 'P' . str_pad($kodeCounter++, 3, '0', STR_PAD_LEFT),
            'nama_penyakit' => $this->faker->word . ' Disease',
            'solusi' => $this->faker->paragraph(2),
        ];
    }
}