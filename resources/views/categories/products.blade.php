@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('categories.index') }}" class="btn btn-link text-decoration-none p-0 text-muted">
            <i class="bi bi-arrow-left"></i> Voltar para categorias
        </a>

        <a href="{{ route('products.create', ['category_id' => $category->id]) }}" class="btn btn-success rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Novo Produto
        </a>
    </div>

    <div class="text-center mb-5">
        <h2 class="fw-bold"><span class="text-primary">{{ $category->category_description }}</span></h2>

        <p class="text-muted">Total de {{ $products->total() }} produtos encontrados</p>
    </div>

    <div class="row g-4">

        @forelse($products as $product)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $product->name }}</h5>
                        <p class="text-muted small">{{ $product->product_description }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold text-success">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary rounded-pill">Ver detalhes</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-box-open fs-1 text-muted"></i>
                <p class="mt-3 text-muted">Nenhum produto cadastrado nesta categoria ainda</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5 pagination-clean">
        {{ $products->links() }}
    </div>
</div>

<style>

    .pagination-clean nav .flex-1.d-none.d-sm-flex { display: none !important; }
    .pagination-clean nav div:first-child { display: none !important; }
    .pagination-clean .pagination { gap: 5px; }
    .pagination-clean .page-link {
        border: none !important;
        border-radius: 10px !important;
        color: #1e0dd8 !important;
        padding: 8px 16px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .pagination-clean .page-item.active .page-link {
        background-color: #1e0dd8 !important;
        color: white !important;
    }
</style>
@endsection