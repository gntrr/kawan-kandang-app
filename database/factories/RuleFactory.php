<?php

namespace Database\Factories;

use App\Models\Rule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rule>
 */
class RuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $kodeCounter = 100;
        
        return [
            'kode_rule' => 'R' . $kodeCounter++,
            'nama_rule' => 'Rule ' . $kodeCounter,
            'if_condition' => 'G001 AND G002',
            'then_condition' => 'P001',
        ];
    }
}