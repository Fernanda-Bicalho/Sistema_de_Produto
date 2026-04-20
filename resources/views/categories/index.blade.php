@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center mb-5 g-4">
        <div class="col-12 col-md-7">
            <h2 class="fw-light text-dark mb-1">
                <span class="text-primary fw-bold">|</span>
                Gerenciamento de categorias
            </h2>
            <p class="text-muted small text-uppercase fw-semibold mb-0" style="letter-spacing: 1px;">
                Organize seu catálogo com simplicidade
            </p>
        </div>
        <div class="col-12 col-md-5 text-md-end">
            <a href="{{ route('categories.create') }}" class="btn btn-warning rounded-pill px-5 py-2 text-white shadow-sm fw-bold" style="background-color: #1e0dd8 ; border: none;">
                <i class="bi bi-plus-circle-fill me-2"></i> Adicionar nova categoria
            </a>
        </div>
    </div>

    <div class="mb-4">
        <div class="input-group shadow-sm rounded-pill overflow-hidden border-0 bg-white px-3">
            <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" id="searchCategory" class="form-control border-0 py-2 fs-6" placeholder="Search category...">
        </div>
    </div>

    <div class="card border-0 shadow-soft rounded-5 mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="categoryTable">
                <thead>
                    <tr>
                        <th class="ps-5 py-4 text-muted small fw-bold text-uppercase border-0">Description</th>
                        <th class="py-4 text-muted small fw-bold text-uppercase border-0">Status</th>
                        <th class="pe-5 py-4 text-muted small fw-bold text-uppercase border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="category-row">
                            <td class="ps-5 py-4">
                                <a href="{{ route('categories.products', $category) }}" class="text-decoration-none">
                                    <span class="d-block text-dark fs-6 fw-medium category-link">{{ $category->category_description }}</span>
                                </a>
                            </td>
                            <td>
                                @if($category->status == 1)
                                    <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                        <i class="bi bi-eye-fill me-1"></i> Ativo
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2">
                                        <i class="bi bi-eye-slash-fill me-1"></i> Inativo
                                    </span>
                                @endif
                            </td>
                            <td class="pe-5 text-end">
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('categories.show', $category) }}" class="btn-action-modern btn-view-modern" title="View">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('categories.products', $category) }}" class="btn-action-modern btn-products-modern" title="Ver Produtos desta Categoria">
                                        <i class="bi bi-box-seam"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn-action-modern btn-edit-modern" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-modern btn-delete-modern" title="Delete">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Nenhuma categoria encontrada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-5 pagination-clean">
        {{ $categories->links() }}
    </div>
</div>

<style>
    :root {
        --primary-soft: #eef2ff;
        --primary-main: #4f46e5;
        --deep-blue: #1e0dd8;
    }
    body { background-color: #f8fafc; }
    .shadow-soft { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); }
    .rounded-5 { border-radius: 1.25rem !important; }

    /* Estilização para deixar a paginação no tom do seu projeto */
    .pagination { gap: 5px; }

    .page-link {
        border: none !important;
        border-radius: 10px !important;
        color: var(--deep-blue) !important;
        padding: 8px 16px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .page-item.active .page-link {
        background-color: var(--deep-blue) !important;
        color: white !important;
    }

    /* Remove o texto "Showing X to Y of Z results" e as setas extras */
    nav .flex-1.d-none.d-sm-flex,
    nav .small.text-muted,
    nav p.small.text-muted {
        display: none !important;
    }

    /* Garante que apenas os números fiquem visíveis e centralizados */
    nav div:first-child {
        display: none !important;
    }

    nav div:last-child {
        display: block !important;
    }

    .category-link { transition: all 0.2s ease; }
    .category-link:hover {
        color: var(--deep-blue) !important;
        text-decoration: underline;
        transform: translateX(3px);
        display: inline-block;
    }

    .btn-action-modern {
        width: 42px; height: 42px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 12px; border: 1px solid #edf2f7;
        background-color: #ffffff; transition: all 0.2s ease;
        text-decoration: none; cursor: pointer;
    }
    .btn-view-modern { color: rgb(73, 70, 229); }
    .btn-view-modern:hover { background-color: #eef2ff; border-color: #c7d2fe; transform: translateY(-2px); }
    .btn-products-modern { color: var(--deep-blue); }
    .btn-products-modern:hover { background-color: #eef2ff; border-color: #c7d2fe; transform: translateY(-2px); }
    .btn-edit-modern { color: #f59e0b; }
    .btn-edit-modern:hover { background-color: #fffbeb; border-color: #fde68a; transform: translateY(-2px); }
    .btn-delete-modern { color: #ef4444; }
    .btn-delete-modern:hover { background-color: #fef2f2; border-color: #fecaca; transform: translateY(-2px); }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchCategory');
        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                document.querySelectorAll('.category-row').forEach(row => {
                    const text = row.querySelector('td').textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        }
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this category?')) {
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