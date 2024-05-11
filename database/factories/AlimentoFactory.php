<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alimento>
 */
class AlimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alimento_descripcion' => $this->faker->unique()->randomElement([
                'Hierba',
                'Heno',
                'Granos',
                'Mezcla',
                'Forraje',
                'Maíz',
                'Trigo',
                'Cebada',
                'Avena',
                'Almidón',
            ]),
            'alimento_cantidad' => $this->faker->randomNumber(4,true),
            'alimento_costo' => $this->faker->randomFloat(2, 1000, 9999.99),
            'user_id' => 1,
            'archivo_nombre'=> 'null',
            'archivo_ubicacion'=>'null',
        ];
    }
}
