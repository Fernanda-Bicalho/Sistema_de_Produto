<?php
namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'product_description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'category_id' => 1,
        ];
    }

    public function especifico(string $categorie)
    {
        $dados = [
            'Eletrônicos'         => ['Smartphones', 'Fones de ouvido', 'Notebooks', 'Impressoras', 'Monitores'],
            'Vestuário'           => ['Camisetas', 'Shorts', 'Jaqueta Jeans', 'Moletons', 'Saias'],
            'Alimentos e Bebidas' => ['lasanha', 'Café', 'Chocolate', 'Frango', 'Cerveja'],
            'Livros'              => ['O Senhor dos Anéis', 'Clean Code', 'Dom Casmurro', '1984 George Orwell', 'Pai Rico Pai Pobre'],
            'Beleza'              => ['Sérum Facial', 'Perfume Importado', 'Kit de Maquiagem', 'Shampoo Sem Sal', 'Protetor Solar'],
            'Esportes'            => ['Bola de Futebol', 'Tapete de Yoga', 'Halteres 5kg', 'Bicicleta Aro 29', 'Raquete de Tênis'],
            'Casa e Decoração'    => ['Luminária Industrial', 'Vaso de Cerâmica', 'Quadro Abstrato', 'Almofada Veludo', 'Espelho Adnet'],
        ];

        return $this->state(function (array $attributes) use ($categorie, $dados) {
            $lista = $dados[$categorie] ?? [$this->faker->word()];
            return [
                'name' => $this->faker->randomElement($lista),
                'product_description' => "Excelente produto da linha de " . $categorie,
            ];
        });
    }
}