@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center mb-5 g-4">
        <div class="col-12 col-md-7">
            <h2 class="fw-light text-dark mb-1">
                <span class="text-primary fw-bold">|</span> Gestão de Produtos
            </h2>
            <p class="text-muted small text-uppercase fw-semibold mb-0" style="letter-spacing: 1px;">
                Controle seu estoque com inteligência
            </p>
        </div>
        <div class="col-12 col-md-5 text-md-end">
            <a href="{{ route('products.create') }}" class="btn shadow-sm rounded-pill px-4 py-2 text-white fw-bold" style="background-color: #1e0dd8;">
                <i class="bi bi-plus-circle-fill me-2"></i> Adicionar Produto
            </a>
        </div>
    </div>

    <div class="mb-4">
        <div class="input-group shadow-sm rounded-pill overflow-hidden border-0 bg-white px-3">
            <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" id="searchProduct" class="form-control border-0 py-2 fs-6" placeholder="Search by name or category...">
        </div>
    </div>

    <div class="card border-0 shadow-soft rounded-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="productTable">
                <thead>
                    <tr>
                        <th class="ps-5 py-4 text-muted small fw-bold text-uppercase border-0">Produto</th>
                        <th class="py-4 text-muted small fw-bold text-uppercase border-0">Categoria</th>
                        <th class="py-4 text-muted small fw-bold text-uppercase border-0 text-center">Preço</th>
                        <th class="pe-5 py-4 text-muted small fw-bold text-uppercase border-0 text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td colspan="4" class="bg-light fw-bold text-dark ps-5 py-3">
                                <i class="bi bi-folder-fill me-2 text-primary"></i>
                                {{ $category->category_description }}
                            </td>
                        </tr>

                        @forelse($category->products as $product)
                            <tr class="product-row">
                                <td class="ps-5 py-4">
                                    <span class="d-block text-dark fs-6 fw-bold">
                                        {{ $product->product_description }}
                                    </span>
                                    <span class="text-muted small">ID: #{{ $product->id }}</span>
                                </td>

                                <td>
                                    <span class="badge-category">
                                        <i class="bi bi-tag-fill me-1"></i>
                                        {{ $category->category_description }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <span class="fw-bold text-dark">
                                        R$ {{ number_format($product->price, 2, ',', '.') }}
                                    </span>
                                </td>

                                <td class="pe-5 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('products.show', $product) }}" class="btn-action-modern" style="color: #1e0dd8;">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <a href="{{ route('products.edit', $product) }}" class="btn-action-modern" style="color: #f59e0b;">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form method="POST" action="{{ route('products.destroy', $product) }}" class="delete-form d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-modern btn-delete-modern">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    Nenhum produto nesta categoria
                                </td>
                            </tr>
                        @endforelse

                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                Nenhuma categoria encontrada.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }

    .shadow-soft { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); }
    .rounded-5 { border-radius: 1.25rem !important; }

    .badge-category {
        background-color: #f1f5f9;
        color: #475569;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .btn-action-modern {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: 1px solid #edf2f7;
        background-color: #ffffff;
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-action-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        background-color: #f8fafc;
    }

    .btn-delete-modern { color: #ef4444; }
    .btn-delete-modern:hover { background-color: #fef2f2; border-color: #fecaca; }

    .form-control:focus { box-shadow: none; border-color: #1e0dd8; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const searchInput = document.getElementById('searchProduct');
        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('.product-row').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this product?')) {
                    const btn = this.querySelector('button');
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
                    btn.disabled = true;
                    this.submit();
                }
            });
        });
    });
</script>
@endsection