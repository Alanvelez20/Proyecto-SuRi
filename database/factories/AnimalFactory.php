<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'animal_especie' => $this->faker->unique()->randomElement([
                'Angus',
                'Charolais',
                'Brahman',
                'Nelore',
                'Hereford',
                'Brangus',
                'Betizu',
                'Wagyu',
                'Rubia gallega',
                'Indobrasil',
            ]), 
            'animal_genero'=> $this->faker->randomElement([
                'Macho',
                'Hembra',
            ]), 
            'animal_peso' => $this->faker->randomNumber(3,true),
            'animal_valor_compra' => $valorCompra = $this->faker->randomNumber(3,true),
            'animal_valor_venta' =>$valorCompra,
            'animal_id_lote' => $this->faker->randomElement([1, 4]),
            'user_id' => 1,
        ];
    }
}
