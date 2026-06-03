@extends('layouts.admin')
@section('title', 'Pedido #' . $pedido->id)
@section('page-title', 'Detalhes do Pedido')

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.pedidos.index') }}" style="color:var(--azul-java);text-decoration:none;font-size:0.88rem;">
        <i class="fa-solid fa-arrow-left me-1"></i>Voltar para Pedidos
    </a>
</div>

<div class="row g-3">
    <div class="col-md-8">
        <div class="form-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0" style="color:var(--azul-java);font-weight:700;">
                    <i class="fa-solid fa-receipt me-2" style="color:var(--vermelho-express);"></i>Pedido #{{ $pedido->id }}
                </h5>
                <span class="badge bg-{{ $statusColors[$pedido->status] ?? 'secondary' }} rounded-pill px-3 py-2" style="font-size:0.85rem;">
                    {{ $statusLabels[$pedido->status] ?? $pedido->status }}
                </span>
            </div>

            <table class="table" style="font-size:0.88rem;">
                <thead style="background:#f8f5f1;">
                    <tr>
                        <th class="py-2">Produto</th>
                        <th class="py-2 text-center">Qtd</th>
                        <th class="py-2 text-end">Preço Unit.</th>
                        <th class="py-2 text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedido->produtos as $produto)
                    <tr>
                        <td class="py-2">{{ $produto->nome }}</td>
                        <td class="py-2 text-center">{{ $produto->pivot->quantidade }}</td>
                        <td class="py-2 text-end">R$ {{ number_format($produto->pivot->preco_unitario, 2, ',', '.') }}</td>
                        <td class="py-2 text-end fw-600">R$ {{ number_format($produto->pivot->preco_unitario * $produto->pivot->quantidade, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="border-top:2px solid #e8e2d8;">
                        <td colspan="3" class="py-2 text-end" style="font-weight:700;color:var(--azul-java);">TOTAL</td>
                        <td class="py-2 text-end" style="font-weight:700;font-size:1.1rem;color:var(--azul-java);">
                            R$ {{ number_format($pedido->total, 2, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>

            @if($pedido->observacoes)
                <div class="p-3 rounded-3 mt-2" style="background:#f8f5f1;">
                    <div style="font-size:0.8rem;color:#888;margin-bottom:0.25rem;">OBSERVAÇÕES</div>
                    <div style="font-size:0.9rem;">{{ $pedido->observacoes }}</div>
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-card">
            <h6 style="color:var(--azul-java);font-weight:700;margin-bottom:1rem;">Informações do Cliente</h6>
            <div class="mb-2">
                <div style="font-size:0.75rem;color:#999;text-transform:uppercase;letter-spacing:1px;">Nome</div>
                <div style="font-weight:600;">{{ $pedido->cliente_nome }}</div>
            </div>
            @if($pedido->cliente_email)
            <div class="mb-2">
                <div style="font-size:0.75rem;color:#999;text-transform:uppercase;letter-spacing:1px;">E-mail</div>
                <div>{{ $pedido->cliente_email }}</div>
            </div>
            @endif
            <div class="mb-2">
                <div style="font-size:0.75rem;color:#999;text-transform:uppercase;letter-spacing:1px;">Data</div>
                <div>{{ $pedido->created_at->format('d/m/Y H:i') }}</div>
            </div>
            <div class="mb-4">
                <div style="font-size:0.75rem;color:#999;text-transform:uppercase;letter-spacing:1px;">Última atualização</div>
                <div>{{ $pedido->updated_at->format('d/m/Y H:i') }}</div>
            </div>

            <div class="d-flex flex-column gap-2">
                <a href="{{ route('admin.pedidos.edit', $pedido) }}" class="btn btn-java">
                    <i class="fa-solid fa-pen me-2"></i>Editar Pedido
                </a>
                <form method="POST" action="{{ route('admin.pedidos.destroy', $pedido) }}"
                      onsubmit="return confirm('Remover pedido #{{ $pedido->id }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-express w-100">
                        <i class="fa-solid fa-trash me-2"></i>Remover
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
