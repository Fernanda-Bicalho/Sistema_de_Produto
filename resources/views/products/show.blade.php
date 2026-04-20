@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('categories.products', $product->category_id) }}" class="btn-back">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7">
            <div class="card border-0 shadow-soft rounded-5 overflow-hidden">
                <div class="header-accent-product"></div>

                <div class="card-body p-5 pt-0 text-center">
                    <div class="icon-header shadow-sm bg-white rounded-circle mx-auto d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-seam text-primary fs-2"></i>
                    </div>

                    <h3 class="fw-bold text-dark mt-3 mb-1">Detalhes do Produto </h3>
                    <p class="text-muted small mb-5 text-uppercase fw-bold" style="letter-spacing: 1px;">Especificações do item</p>

                    <div class="row g-4 text-start">
                        <div class="col-12">
                            <div class="info-box shadow-sm border border-light p-3 rounded-4 bg-light bg-opacity-25">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Nome do produto</label>
                                <span class="fs-5 text-dark fw-medium">{{ $product->name }}</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box shadow-sm border border-light p-3 rounded-4 bg-light bg-opacity-25">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">ID de Referência</label>
                                <span class="text-secondary fw-bold">#{{ $product->category_id }}</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box shadow-sm border border-light p-3 rounded-4 bg-light bg-opacity-25">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Preço</label>
                                <span class="text-success fw-bold">$ {{ number_format($product->price, 2, '.', ',') }}</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box shadow-sm border border-light p-3 rounded-4 bg-light bg-opacity-25">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Categoria</label>
                                <span class="badge bg-primary-soft text-primary rounded-pill px-3 py-2">
                                    {{ $product->category->category_description ?? 'Uncategorized'}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top d-flex justify-content-center gap-3">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning rounded-pill px-5 text-white shadow-sm fw-bold" style="background-color: #1e0dd8 ; border: none;">
                            <i class="bi bi-pencil-square me-2"></i>Editar Produto

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --bg-body: #f8fafc;
    }

    body { background-color: var(--bg-body); }

    .shadow-soft { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.04), 0 10px 10px -5px rgba(0, 0, 0, 0.01) !important; }
    .rounded-5 { border-radius: 1.5rem !important; }
    .rounded-4 { border-radius: 1rem !important; }


    .btn-back {
        color: #64748b;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        transition: all 0.2s;
    }
    .btn-back:hover { color: var(--primary-color); transform: translateX(-3px); }

    .header-accent-product {
        height: 100px;
        background: linear-gradient(135deg, #6366f1 0%, #a5b4fc 100%);
        opacity: 0.15;
    }

    .icon-header {
        width: 80px;
        height: 80px;
        margin-top: -40px;
        border: 4px solid #fff;
    }

    .bg-primary-soft { background-color: #eef2ff; }

    .info-box { transition: all 0.2s; border: 1px solid #f1f5f9 !important; }
    .info-box:hover { transform: translateY(-3px); border-color: #e2e8f0 !important; }

    .btn-warning {
        background-color: #f59e0b;
        border: none;
        transition: all 0.3s;
    }
    .btn-warning:hover {
        background-color: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);
    }
</style>
@endsection