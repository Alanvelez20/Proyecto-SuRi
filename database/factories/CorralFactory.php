<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Corral>
 */
class CorralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'corral_nombre'=> $this->faker->unique()->randomElement([
                'Vacas',
                'Toros',
                'Becerros'
            ]), 
            'corral_estado'=> $this->faker->randomElement([
                'Ocupado',
                'Vacío',
            ]), 
            'user_id' => 1,
        ];
    }
}
