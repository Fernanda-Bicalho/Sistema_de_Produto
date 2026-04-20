<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index(Request $request, $categoryId = null): View
    {
        $products = $this->productService->listProducts($categoryId);
        $categories = $this->productService->getAllCategories();

        return view('products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = $this->productService->getAllCategories();

        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = $this->productService->save($request->validated());

        return redirect()
            ->route('categories.products', $product->category_id)
            ->with('success', 'Product saved successfully!');
    }

    public function show(Product $product): View
    {
        $product = $this->productService->getProductForShow($product);

        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = $this->productService->getAllCategories();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->productService->update($product, $request->validated());

        return redirect()
            ->route('categories.products', $product->category_id)
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if (!$this->productService->delete($product)) {
            return redirect()->back()->withErrors(['product' => 'Could not delete the product.']);
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}