@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('produtos.index') }}" class="text-decoration-none text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">
            <i class="bi bi-arrow-left me-1"></i> Voltar à Lista de Produtos
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <div class="card border-0 shadow-soft rounded-5">
                <div class="card-body p-5">

                    <div class="mb-5 text-center">
                        <div class="bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-box-seam text-primary fs-3"></i>
                        </div>
                        <h3 class="fw-bold text-dark">{{ isset($produto) ? 'Edit Product' : 'Create New Product' }}</h3>
                        <p class="text-muted small">
                            {{ isset($produto) ? 'Update the details for product #' . $product->category_id : 'Fill in the information below to register a new product' }}
                        </p>
                    </div>

                    <form method="POST" action="{{ isset($produto) ? route('produtos.update', $produto) : route('produtos.store') }}" id="productForm">
                        @csrf
                        @if(isset($produto))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase">Product Name</label>
                            <div class="input-group shadow-sm rounded-4 overflow-hidden border">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-tag text-primary"></i></span>
                                <input type="text" name="name"
                                       class="form-control border-0 py-3 @error('name') is-invalid @enderror"
                                       placeholder="e.g. Mechanical Keyboard"
                                       value="{{ old('name', $product->product_description ?? '') }}">
                            </div>
                            @error('name')
                                <div class="text-danger small mt-2 ps-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold text-uppercase">Preço($)</label>
                                <div class="input-group shadow-sm rounded-4 overflow-hidden border">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-currency-dollar text-primary"></i></span>
                                    <input type="number" step="0.01" name="price"
                                           class="form-control border-0 py-3 @error('price') is-invalid @enderror"
                                           placeholder="0.00"
                                           value="{{ old('price', $product->preco ?? '') }}">
                                </div>
                                @error('price')
                                    <div class="text-danger small mt-2 ps-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold text-uppercase">Categoria</label>
                                <div class="input-group shadow-sm rounded-4 overflow-hidden border">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-list-stars text-primary"></i></span>
                                    <select name="category_id" class="form-select border-0 py-3 @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}"
                                                {{ (old('category_id', $product->category_id ?? '') == $category_id) ? 'selected' : '' }}>
                                                {{ $category->category_description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <div class="text-danger small mt-2 ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 pt-4">
                            <div class="col-6">
                                <a href="{{ route('produtos.index') }}" class="btn btn-light rounded-pill w-100 py-3 fw-bold text-muted border">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary rounded-pill w-100 py-3 fw-bold shadow-sm" id="btnSubmit">
                                    Salvar Produto
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
        --primary-main: #4f46e5;
        --bg-body: #f8fafc;
    }

    body { background-color: var(--bg-body); }

    .shadow-soft {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.03), 0 10px 10px -5px rgba(0, 0, 0, 0.01) !important;
    }

    .rounded-4 { border-radius: 1rem !important; }
    .rounded-5 { border-radius: 1.5rem !important; }

    .input-group:focus-within {
        border-color: var(--primary-main) !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: none !important;
        background-color: transparent;
    }

    .btn-primary {
        background-color: var(--primary-main);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('productForm');
        const btn = document.getElementById('btnSubmit');

        form.addEventListener('submit', function() {
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
            btn.disabled = true;
        });
    });
</script>
@endsection