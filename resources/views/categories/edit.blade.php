@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('categories.index') }}" class="text-decoration-none text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">
            <i class="bi bi-arrow-left me-1"></i>
            Cancelar e voltar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-soft rounded-5">
                <div class="card-body p-5">

                    <div class="mb-5 text-center">
                        <div class="bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-pencil-square text-warning fs-3"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Editar Categoria</h3>
                        <p class="text-muted small"> Atualizar informações para o registro #{{ $category->id }} </p>
                    </div>
                    <form action="{{ route('categories.update', $category) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="category_description" class="form-label text-muted small fw-bold text-uppercase">Descrição da Categoria</label>
                            <div class="input-group input-group-merge shadow-sm rounded-4 overflow-hidden border">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-card-text text-primary"></i></span>
                                <input type="text"
                                       name="category_description"
                                       class="form-control border-0 py-3 @error('category_description') is-invalid @enderror"
                                       id="category_description"
                                       placeholder="Ex: Electronics, Clothing..."
                                       value="{{ old('description', $category->category_description) }}">
                            </div>
                            @error('category_description')
                                <div class="text-danger small mt-2 ps-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="status" class="form-label text-muted small fw-bold text-uppercase">Status de Visibilidade</label>
                            <div class="input-group shadow-sm rounded-4 overflow-hidden border">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-toggle-on text-primary"></i></span>
                                <select name="status" class="form-select border-0 py-3" id="status">
                                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>🟢 Ativo</option>
                                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>🔴 Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mt-4">
                            <div class="col-6">
                                <a href="{{ route('categories.index') }}"
                                   class="btn rounded-pill w-100 py-2 text-white shadow-sm fw-bold"
                                   style="background-color: #1e0dd8; border: none;">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit"
                                        class="btn rounded-pill w-100 py-2 text-white shadow-sm fw-bold"
                                        id="btnSubmit"
                                        style="background-color: #1e0dd8; border: none;">
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
        --primary-main: #4f46e5;
        --bg-body: #eef2f7;
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
        background-color: #1e0dd8;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1e0dd8;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
    }

    .input-group-text { padding-left: 1.25rem; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editForm');
        const btn = document.getElementById('btnSubmit');

        form.addEventListener('submit', function() {
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
            btn.disabled = true;
        });
    });
</script>
@endsection