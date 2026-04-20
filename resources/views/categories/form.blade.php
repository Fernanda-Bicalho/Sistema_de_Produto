@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-dark mb-4">
        {{ isset($category) ? 'Edit' : 'New' }} Categoria
    </h2>

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <form method="POST" action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}">
            @csrf

            @if(isset($category))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase text-muted">Nome da Categoria</label>
                <input type="text"
                       name="name"
                       class="form-control py-2 @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name ?? '') }}"
                       placeholder="e.g. Electronics"
                       required>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn rounded-pill px-4 text-white fw-bold" style="background-color: #1e0dd8;">
                    <i class="bi bi-check-circle-fill me-1"></i> Salvar Alterações

                </button>

                <a href="{{ route('categories.index') }}" class="btn btn-light rounded-pill px-4 fw-bold border">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection