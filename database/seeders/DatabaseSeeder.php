<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $namesCategories = [
            'Eletrônicos',
            'Vestuário',
            'Alimentos e Bebidas',
            'Livros',
            'Beleza',
            'Esportes',
            'Casa e Decoração'
        ];

        foreach ($namesCategories as $name) {
            Category::create([
                'category_description' => $name
            ]);
        }


        $categories = Category::all();


        foreach ($categories as $categorie) {
            Product::factory()
                ->count(5)
                ->especifico($categorie->category_description)
                ->create([
                    'category_id' => $categorie->id
                ]);
        }

        $this->command->info("Categorias e Produtos populados com sucesso!");
    }
}