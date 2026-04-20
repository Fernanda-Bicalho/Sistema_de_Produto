@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('categories.products', $product->category_id) }}" class="btn btn-light rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i> Voltar para a Categoria
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-soft rounded-5 overflow-hidden">
                <div style="height: 6px; background: linear-gradient(90deg, #4f46e5, #1e0dd8);"></div>

                <div class="card-body p-4 p-md-5">
                    <div class="mb-5 text-center">
                        <div class="bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-box-seam-fill text-primary fs-2"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Editar produto</h3>
                        <p class="text-muted">Atualizar informações para: <span class="text-primary fw-semibold">{{ $product->name }}</span></p>
                    </div>

                    <form action="{{ route('products.update', $product)}}" method="POST" id="editProductForm">
                        @csrf
                        @method('PUT')

                        <div class="row g-4 text-start">

                            <div class="col-12">
                                <label for="name" class="form-label text-muted small fw-bold text-uppercase tracking-wider">Nome do produto</label>
                                <div class="input-group modern-input-group shadow-sm rounded-4 overflow-hidden border">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-tag-fill text-primary"></i></span>
                                    <input type="text" name="name"
                                           class="form-control border-0 py-3 @error('name') is-invalid @enderror"
                                           id="name" placeholder="Enter product name"
                                           value="{{ old('name', $product->name) }}">
                                </div>
                                @error('name') <div class="text-danger small mt-1 ps-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="category_id" class="form-label text-muted small fw-bold text-uppercase tracking-wider">Categoria</label>
                                <div class="input-group modern-input-group shadow-sm rounded-4 overflow-hidden border">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-grid-fill text-primary"></i></span>
                                    <select name="category_id" class="form-select border-0 py-3" id="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label text-muted small fw-bold text-uppercase tracking-wider">Preço ($)</label>
                                <div class="input-group modern-input-group shadow-sm rounded-4 overflow-hidden border">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-currency-dollar text-primary"></i></span>
                                    <input type="number" name="price" step="0.01"
                                           class="form-control border-0 py-3 @error('price') is-invalid @enderror"
                                           id="price" placeholder="0.00"
                                           value="{{ old('price', $product->price) }}">
                                </div>
                                @error('price') <div class="text-danger small mt-1 ps-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label for="product_description" class="form-label text-muted small fw-bold text-uppercase tracking-wider">Descrição</label>
                                <div class="shadow-sm rounded-4 overflow-hidden border">
                                    <textarea name="product_description" {{-- AQUI: mudou de description para product_description --}}
                                              class="form-control border-0 py-3 @error('product_description') is-invalid @enderror"
                                              id="product_description" rows="4"
                                              placeholder="Write a brief description about the product...">{{ old('product_description', $product->product_description) }}</textarea>
                                </div>
                                @error('product_description')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        <div class="row g-3 mt-5">
                            <div class="col-md-6 order-2 order-md-1">
                                <a href="{{ route('categories.products', $product->category_id) }}"
                                   class="btn btn-light rounded-pill w-100 py-3 fw-bold text-white shadow-sm border"
                                   style="background-color: #1e0dd8;">
                                   Descartar Alterações
                                </a>
                            </div>

                            <div class="col-md-6 order-1 order-md-2">
                                <button type="submit" class="btn rounded-pill w-100 py-3 text-white fw-bold shadow-lg main-btn" id="btnSubmit">
                                    Salvar Alterações

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-indigo: #4f46e5;
        --deep-blue: #1e0dd8;
        --soft-bg: #f8fafc;
    }

    body { background-color: var(--soft-bg); font-family: 'Inter', sans-serif; }

    .shadow-soft { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.04), 0 10px 10px -5px rgba(0, 0, 0, 0.01) !important; }
    .rounded-5 { border-radius: 1.5rem !important; }
    .rounded-4 { border-radius: 1rem !important; }
    .tracking-wider { letter-spacing: 0.05em; font-size: 0.75rem; }

    .modern-input-group:focus-within {
        border-color: var(--primary-indigo) !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: none !important;
        background-color: transparent;
    }

    .input-group-text {
        padding-left: 1.25rem;
    }

    .main-btn {
        background-color: var(--deep-blue);
        border: none;
        transition: all 0.3s ease;
    }

    .main-btn:hover {
        background-color: var(--primary-indigo);
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(30, 13, 216, 0.3) !important;
    }

    .spinner-border { width: 1.2rem; height: 1.2rem; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editProductForm');
        const btn = document.getElementById('btnSubmit');

        form.addEventListener('submit', function() {
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Updating...';
            btn.classList.add('opacity-75');
            btn.disabled = true;
        });

        const card = document.querySelector('.card');
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'all 0.6s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    });
</script>
@endsection