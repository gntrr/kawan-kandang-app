<?php

namespace Database\Factories;

use App\Models\DiagnosisHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiagnosisHistory>
 */
class DiagnosisHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiagnosisHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gejala_dipilih' => json_encode(['G001', 'G002', 'G003']),
            'hasil_penyakit' => 'P001',
            'solusi' => $this->faker->paragraph(2),
            'tanggal_diagnosis' => now(),
        ];
    }
}