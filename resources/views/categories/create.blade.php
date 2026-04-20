@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="mb-4">
                <a href="{{ route('categories.index') }}" id="btn-back" class="btn-back d-inline-flex align-items-center text-decoration-none">
                    <i class="bi bi-arrow-left-circle-fill me-2 fs-5"></i>
                    <span class="fw-bold text-uppercase small" style="letter-spacing: 1px;">Voltar</span>
                </a>
            </div>

            <div class="card border-0 shadow-soft rounded-5 overflow-hidden bg-white">
                <div class="header-accent-green"></div>

                <div class="card-body p-4 p-md-5 pt-0">
                    <div class="icon-header-form shadow-sm bg-white rounded-circle mx-auto d-flex align-items-center justify-content-center">
                        <i class="bi bi-grid-fill text-success fs-2"></i>
                    </div>

                    <div class="text-center mb-5">
                        <h3 class="fw-bold text-dark mt-3"> Nova Categoria </h3>
                        <p class="text-muted small text-uppercase fw-semibold" style="letter-spacing: 1px;">Preencha os detalhes abaixo</p>
                    </div>

                    <form action="{{ route('categories.store') }}" method="POST" id="categoryForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="description" class="form-label small fw-bold text-uppercase text-muted">Descrição da Categoria</label>
                                <div class="input-group custom-input-group shadow-sm rounded-4">
                                    <span class="input-group-text bg-white border-end-0 ps-3">
                                        <i class="bi bi-pencil-square text-success"></i>
                                    </span>
                                    <input type="text"
                                           name="category_description"
                                           class="form-control border-start-0 py-3 @error('category_description') is-invalid @enderror"
                                           id="description"
                                           value="{{ old('category_description') }}"
                                           placeholder="Ex: Descrição detalhada"
                                           required>
                                </div>
                                @error('category_description')
                                    <div class="text-danger small mt-2">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label small fw-bold text-uppercase text-muted">Status</label>
                                <div class="input-group custom-input-group shadow-sm rounded-4">
                                    <span class="input-group-text bg-white border-end-0 ps-3">
                                        <i class="bi bi-toggle-on text-success"></i>
                                    </span>
                                    <select name="status"
                                            class="form-select border-start-0 py-3 @error('status') is-invalid @enderror"
                                            id="status"
                                            required>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Ativo</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inativo</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-danger small mt-2">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button type="submit" class="btn rounded-pill px-5 py-3 text-white shadow-sm fw-bold " id="btnSubmit" style="background-color: #1e0dd8; border: none; transition: 0.3s;">
                                <i class="bi bi-check-circle-fill me-2"></i> Salvar Categoria
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --success-main: #198754;
        --success-soft: #eafaf1;
        --bg-body: #f8fafc;
    }

    body { background-color: var(--bg-body); font-family: 'Inter', sans-serif; }
    .shadow-soft { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.04), 0 10px 10px -5px rgba(0, 0, 0, 0.01) !important; }
    .rounded-5 { border-radius: 1.5rem !important; }
    .rounded-4 { border-radius: 1rem !important; }

    .header-accent-green {
        height: 120px;
        background: linear-gradient(135deg, #198754 0%, #2ecc71 100%);
        opacity: 0.1;
    }

    .icon-header-form {
        width: 80px;
        height: 80px;
        margin-top: -40px;
        border: 5px solid #fff;
        position: relative;
        z-index: 10;
    }

    .custom-input-group {
        overflow: hidden;
        border: 1px solid #edf2f7;
        transition: all 0.3s ease;
    }

    .custom-input-group:focus-within {
        border-color: var(--success-main);
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1) !important;
    }

    .form-control, .form-select {
        border: none;
        font-weight: 500;
        color: #334155;
    }

    .form-control:focus, .form-select:focus { box-shadow: none; }
    .btn-back { color: #64748b; transition: all 0.2s; }
    .btn-back:hover { color: var(--success-main); transform: translateX(-3px); }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('categoryForm');
        const btnSubmit = document.getElementById('btnSubmit');

        if(form) {
            form.addEventListener('submit', function() {
                btnSubmit.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    PROCESSANDO...
                `;
                btnSubmit.classList.add('disabled');
                btnSubmit.style.opacity = '0.8';
            });
        }
    });
</script>
@endsection