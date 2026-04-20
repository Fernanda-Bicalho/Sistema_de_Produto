@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('categories.index') }}" class="btn-back d-inline-flex align-items-center">
            <i class="bi bi-arrow-left-circle-fill me-2 fs-5"></i>
            <span>Voltar</span>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7">
            <div class="card border-0 shadow-soft rounded-5 overflow-hidden bg-white">
                <div class="header-accent"></div>

                <div class="card-body p-4 p-md-5 pt-0 text-center">
                    <div class="icon-header shadow-sm bg-white rounded-circle mx-auto d-flex align-items-center justify-content-center">
                        <i class="bi bi-bookmark-star-fill text-primary fs-2"></i>
                    </div>

                    <h3 class="fw-bold text-dark mt-3 mb-1">Descrição da Categoria</h3>
                    <p class="text-muted small mb-5 text-uppercase fw-bold tracking-wider">
                        Registrar informações
                    </p>

                    <div class="row g-4 text-start">
                        <div class="col-12">
                            <div class="info-box shadow-sm border border-light p-3 rounded-4 bg-light bg-opacity-25">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Descrição da Categoria</label>
                                <span class="fs-5 text-dark fw-semibold">{{ $category->category_description }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box shadow-sm border border-light p-3 rounded-4 bg-light bg-opacity-25">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">ID do Registro</label>
                                <span class="text-secondary fw-bold">
                                    <i class="bi bi-hash me-1"></i>{{ $category->id }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box shadow-sm border border-light p-3 rounded-4 bg-light bg-opacity-25">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Status Atual</label>
                                @if($category->status)
                                    <span class="badge-status bg-success-soft text-success">
                                        <span class="dot bg-success"></span> Ativo no Catálogo

                                    </span>
                                @else
                                    <span class="badge-status bg-secondary-soft text-secondary">
                                        <span class="dot bg-secondary"></span> Inativo no Catálogo
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning rounded-pill px-5 py-2 text-white shadow-sm fw-bold" style="background-color: #1e0dd8;">
                            <i class="bi bi-pencil-square me-2"></i> Editar Dados
                        </a>

                        <button type="button" class="btn btn-warning rounded-pill px-5 py-2 text-white shadow-sm fw-bold" onclick="window.print()" style="background-color: #1e0dd8;">
                            <i class="bi bi-printer me-2"></i>Imprimir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-light: #818cf8;
        --bg-body: #f8fafc;
        --transition-base: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background-color: var(--bg-body);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .tracking-wider { letter-spacing: 1.5px; }

    .shadow-soft {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.04), 0 10px 10px -5px rgba(0, 0, 0, 0.01) !important;
    }
    .rounded-5 { border-radius: 1.5rem !important; }
    .rounded-4 { border-radius: 1rem !important; }

    .btn-back {
        color: #64748b;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        transition: var(--transition-base);
    }
    .btn-back:hover {
        color: var(--primary-color);
        transform: translateX(-5px);
    }

    .header-accent {
        height: 120px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        opacity: 0.15;
    }

    .icon-header {
        width: 84px;
        height: 84px;
        margin-top: -42px;
        border: 5px solid #fff;
        position: relative;
        z-index: 10;
    }

    .info-box {
        transition: var(--transition-base);
        background-color: rgba(248, 250, 252, 0.5);
    }
    .info-box:hover {
        transform: translateY(-4px);
        background-color: #fff;
        border-color: var(--primary-light) !important;
    }

    .badge-status {
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid transparent;
    }
    .dot { width: 8px; height: 8px; border-radius: 50%; }
    .bg-success-soft { background-color: #ecfdf5; border-color: #d1fae5; }
    .bg-secondary-soft { background-color: #f1f5f9; border-color: #e2e8f0; }

    .btn-warning {
        background-color: #f59e0b;
        border: none;
        transition: var(--transition-base);
    }
    .btn-warning:hover {
        background-color: #d97706;
        transform: scale(1.03);
        box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3) !important;
    }

    @media (max-width: 576px) {
        .card-body { padding: 2rem 1.5rem !important; }
        .icon-header { width: 70px; height: 70px; margin-top: -35px; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
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