@extends('layouts.admin')
@section('title', 'Pedidos')
@section('page-title', 'Gerenciar Pedidos')

@section('content')

{{-- Filtros --}}
<form method="GET" action="{{ route('admin.pedidos.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="busca" class="form-control" placeholder="Buscar por cliente..." value="{{ request('busca') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Todos os status</option>
                @foreach($statusLabels as $key => $label)
                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-java w-100">
                <i class="fa-solid fa-magnifying-glass me-1"></i>Filtrar
            </button>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.pedidos.create') }}" class="btn btn-express w-100">
                <i class="fa-solid fa-plus me-1"></i>Novo Pedido
            </a>
        </div>
    </div>
</form>

<div class="table-card">
    <div class="table-card-header">
        <h5><i class="fa-solid fa-receipt me-2" style="color:var(--vermelho-express);"></i>
            Pedidos <span class="badge bg-secondary ms-1" style="font-size:0.75rem;">{{ $pedidos->total() }}</span>
        </h5>
    </div>

    @if($pedidos->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-receipt fa-2x mb-2 d-block"></i>Nenhum pedido encontrado.
            <br><a href="{{ route('admin.pedidos.create') }}" class="btn btn-java btn-sm mt-3">Registrar primeiro pedido</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size:0.88rem;">
                <thead style="background:#f8f5f1;">
                    <tr>
                        <th class="px-4 py-3" style="color:#888;font-weight:600;">#</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Cliente</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Itens</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Total</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Status</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Data</th>
                        <th class="py-3" style="color:#888;font-weight:600;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                    <tr>
                        <td class="px-4 py-3 text-muted">#{{ $pedido->id }}</td>
                        <td class="py-3">
                            <div style="font-weight:600;">{{ $pedido->cliente_nome }}</div>
                            @if($pedido->cliente_email)
                                <div class="text-muted" style="font-size:0.78rem;">{{ $pedido->cliente_email }}</div>
                            @endif
                        </td>
                        <td class="py-3">{{ $pedido->produtos->count() }} item(ns)</td>
                        <td class="py-3" style="font-weight:600;">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                        <td class="py-3">
                            <span class="badge bg-{{ $statusColors[$pedido->status] ?? 'secondary' }} rounded-pill px-3">
                                {{ $statusLabels[$pedido->status] ?? $pedido->status }}
                            </span>
                        </td>
                        <td class="py-3 text-muted">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.pedidos.show', $pedido) }}" class="btn btn-sm" style="background:#f3f0eb;color:#523725;border-radius:8px;">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.pedidos.edit', $pedido) }}" class="btn btn-sm btn-java">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.pedidos.destroy', $pedido) }}"
                                      onsubmit="return confirm('Remover pedido #{{ $pedido->id }}?')">
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

        @if($pedidos->hasPages())
            <div class="px-4 py-3 border-top" style="background:#fafaf8;">
                {{ $pedidos->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
