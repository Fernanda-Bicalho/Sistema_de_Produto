@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4 text-start">
        <a href="{{ request('category_id') ? route('categories.show', request('category_id')) : route('categories.index') }}"
   class="text-decoration-none text-muted small fw-bold text-uppercase d-inline-flex align-items-center"
   style="letter-spacing: 1px;">
    <i class="bi bi-arrow-left-circle-fill me-2 fs-5 text-primary"></i>
    Voltar
</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-soft rounded-5 overflow-hidden">
                <div style="height: 6px; background: linear-gradient(90deg, #1e0dd8, #4f46e5);"></div>

                <div class="card-body p-4 p-md-5">
                    <div class="mb-5 text-center">
                        <div class="bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-plus-circle-fill text-primary fs-2"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Novo produto
                        </h3>
                        <p class="text-muted small">Preencha os campos abaixo para cadastrar o item no sistema</p>
                    </div>
                    <form action="{{ route('products.store') }}" method="POST" id="createProductForm">
                        @csrf

                        <div class="row g-4 text-start">
                            <div class="col-12">
                                <label for="name" class="form-label text-muted small fw-bold text-uppercase tracking-wider"> Nome do Produto

                                </label>
                                <div class="input-group modern-input-group shadow-sm rounded-4 overflow-hidden border">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-tag-fill text-primary"></i></span>
                                    <input type="text" name="name"
                                           class="form-control border-0 py-3 @error('name') is-invalid @enderror"
                                           id="name" placeholder="Ex: Teclado Mecânico RGB"
                                           value="{{ old('name') }}">
                                </div>
                                @error('name') <div class="text-danger small mt-1 ps-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="category_id" class="form-label text-muted small fw-bold text-uppercase tracking-wider">Categoria</label>
                                <div class="input-group modern-input-group shadow-sm rounded-4 overflow-hidden border">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-grid-fill text-primary"></i></span>
                                    <select name="category_id" id="category_id" class="form-select border-start-0 py-3 @error('category_id') is-invalid @enderror" required>
                                        <option value="" disabled {{ !request('category_id') ? 'selected' : '' }}>Selecione uma categoria...</option>

                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (old('category_id') == $category->id || request('category_id') == $category->id) ? 'selected' : '' }}>
                                                {{ $category->category_description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id') <div class="text-danger small mt-1 ps-2">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label text-muted small fw-bold text-uppercase tracking-wider">Preço(R$)</label>
                                <div class="input-group modern-input-group shadow-sm rounded-4 overflow-hidden border">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-currency-dollar text-primary"></i></span>
                                    <input type="number" name="price" step="0.01"
                                           class="form-control border-0 py-3 @error('price') is-invalid @enderror"
                                           id="price" placeholder="0,00"
                                           value="{{ old('price') }}">
                                </div>
                                @error('price') <div class="text-danger small mt-1 ps-2">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="product_description" class="form-label text-muted small fw-bold text-uppercase tracking-wider">Descrição</label>
                                <div class="shadow-sm rounded-4 overflow-hidden border">
                                    <textarea name="product_description"
                                              class="form-control border-0 py-3 @error('product_description') is-invalid @enderror"
                                              id="product_description" rows="4"
                                              placeholder="Conte um pouco mais sobre o produto...">{{ old('product_description') }}</textarea>
                                </div>
                                @error('product_description') <div class="text-danger small mt-1 ps-2">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-md-6 order-2 order-md-1">
                                <a href="{{ route('categories.index') }}" class="btn btn-light rounded-pill w-100 py-3 fw-bold text-white shadow-sm border"style="background-color: #1e0dd8;">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-md-6 order-1 order-md-2">
                                <button type="submit" class="btn rounded-pill w-100 py-3 text-white fw-bold shadow-lg main-btn" id="btnSubmit">
                                    Registrar produto
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

    .shadow-soft { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.04) !important; }
    .rounded-5 { border-radius: 1.5rem !important; }
    .rounded-4 { border-radius: 1rem !important; }
    .tracking-wider { letter-spacing: 0.05em; font-size: 0.75rem; }

    .modern-input-group { transition: all 0.2s ease; }
    .modern-input-group:focus-within {
        border-color: var(--primary-indigo) !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: none !important;
        background-color: transparent;
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
        const form = document.getElementById('createProductForm');
        const btn = document.getElementById('btnSubmit');

        form.addEventListener('submit', function() {
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Salvando...';
            btn.classList.add('opacity-75');
            btn.disabled = true;
        });
    });
</script>
@endsection