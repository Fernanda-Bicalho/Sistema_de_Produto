<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'category_description' => $this->faker->randomElement([
                'Eletrônicos',
                'Vestuário',
                'Alimentos e Bebidas',
                'Livros',
                'Beleza',
                'Esportes',
                'Casa e Decoração'
            ]),
            'status' => $this->faker->boolean(80),

        ];
    }
}
