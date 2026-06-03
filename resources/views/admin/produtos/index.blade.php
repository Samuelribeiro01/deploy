@extends('layouts.admin')
@section('title', 'Produtos')
@section('page-title', 'Gerenciar Produtos')

@section('content')

{{-- Filtros --}}
<form method="GET" action="{{ route('admin.produtos.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="busca" class="form-control" placeholder="Buscar produto..." value="{{ request('busca') }}">
        </div>
        <div class="col-md-3">
            <select name="categoria" class="form-select">
                <option value="">Todas as categorias</option>
                @foreach(\App\Models\Produto::categorias() as $key => $label)
                    <option value="{{ $key }}" {{ request('categoria') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-java w-100">
                <i class="fa-solid fa-magnifying-glass me-1"></i>Filtrar
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.produtos.create') }}" class="btn btn-express w-100">
                <i class="fa-solid fa-plus me-1"></i>Novo
            </a>
        </div>
    </div>
</form>

<div class="table-card">
    <div class="table-card-header">
        <h5><i class="fa-solid fa-mug-saucer me-2" style="color:var(--vermelho-express);"></i>
            Produtos <span class="badge bg-secondary ms-1" style="font-size:0.75rem;">{{ $produtos->total() }}</span>
        </h5>
    </div>

    @if($produtos->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-mug-saucer fa-2x mb-2 d-block"></i>Nenhum produto encontrado.
            <br><a href="{{ route('admin.produtos.create') }}" class="btn btn-java btn-sm mt-3">Adicionar primeiro produto</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size:0.88rem;">
                <thead style="background:#f8f5f1;">
                    <tr>
                        <th class="px-4 py-3" style="color:#888;font-weight:600;">#</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Produto</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Categoria</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Preço</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Status</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $produto)
                    <tr>
                        <td class="px-4 py-3 text-muted">{{ $produto->id }}</td>
                        <td class="py-3">
                            <div class="fw-600" style="font-weight:600;">{{ $produto->nome }}</div>
                            @if($produto->descricao)
                                <div class="text-muted" style="font-size:0.78rem;">{{ Str::limit($produto->descricao, 60) }}</div>
                            @endif
                        </td>
                        <td class="py-3">
                            <span class="badge rounded-pill px-3" style="background:rgba(41,31,115,0.1);color:var(--azul-java);font-weight:500;">
                                {{ \App\Models\Produto::categorias()[$produto->categoria] ?? $produto->categoria }}
                            </span>
                        </td>
                        <td class="py-3 fw-600">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td class="py-3">
                            @if($produto->disponivel)
                                <span class="badge bg-success rounded-pill px-3">Disponível</span>
                            @else
                                <span class="badge bg-secondary rounded-pill px-3">Indisponível</span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.produtos.edit', $produto) }}" class="btn btn-sm btn-java">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.produtos.destroy', $produto) }}"
                                      onsubmit="return confirm('Remover {{ addslashes($produto->nome) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-express">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        @if($produtos->hasPages())
            <div class="px-4 py-3 border-top" style="background:#fafaf8;">
                {{ $produtos->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
