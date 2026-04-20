<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::resource('categories', CategoryController::class);
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}/products', [CategoryController::class, 'showProducts'])->name('categories.products');


Route::resource('products', ProductController::class);
Route::get('/products/category/{category}', [ProductController::class, 'index'])->name('products.category');

