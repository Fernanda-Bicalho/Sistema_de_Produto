<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class CategoryService
{

    public function listAll()
    {
        return Category::with('products')
            ->orderBy('status', 'desc')
            ->paginate(5);

    }


    public function getAll(): Collection
    {
        return Category::all();
    }


    public function store(array $data): Category
    {
        return Category::create([
            'category_description' => $data['category_description'],
            'status' => 1,
        ]);
    }

    public function update(Category $category, array $data): bool
    {
        return $category->update([

            'category_description' => $data['category_description'],
            'status'               => $data['status'],
        ]);
    }


    public function getCategoryWithProducts(Category $category): Category
    {
        return $category->load('products');
    }


    public function deleteWithProducts(Category $category): bool
    {
        return DB::transaction(function () use ($category) {
            $category->products()->delete();
            return $category->delete();
        });
    }
}