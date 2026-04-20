<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{

        public function listProducts(?int $categoryId = null)
    {
        $query = Product::with('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->paginate(9);
    }

    public function getAllCategories(): Collection
    {
        return Category::all();
    }


    public function save(array $data): Product
    {
        return Product::create($data);
    }


    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }


    public function delete(Product $product): bool
    {
        return $product->delete();
    }


    public function getProductForShow(Product $product): Product
    {
        return $product->load('category');
    }
}