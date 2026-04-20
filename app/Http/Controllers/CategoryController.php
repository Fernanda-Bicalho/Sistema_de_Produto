<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}

    public function index(): View
    {
        $categories = $this->categoryService->listAll();
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        $categories = $this->categoryService->getAll();
        return view('categories.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->store($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->categoryService->update($category, $request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

        public function showProducts(Category $category): View
    {

        $category = $this->categoryService->getCategoryWithProducts($category);


        $products = $category->products()->paginate(9);


        return view('categories.products', compact('category', 'products'));
    }
    public function destroy(Category $category): RedirectResponse
    {
        $this->categoryService->deleteWithProducts($category);

        return redirect()->route('categories.index')
            ->with('success', 'Categoria e produtos removidos com sucesso!');
    }
}