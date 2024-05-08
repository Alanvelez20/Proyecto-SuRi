<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lote>
 */
class LoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lote_nombre'=> $this->faker->unique()->randomElement([
                'Blancas',
                'Negras',
                'Cafes',
                'Pintas',
            ]), 
            'lote_cantidad'=> $this->faker->randomNumber(2,true),
            'lote_id_corral'=> $this->faker->randomElement([1, 2]),
            'user_id' => 1,
        ];
    }
}
