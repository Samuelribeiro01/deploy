@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Cards de Estatísticas --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label"><i class="fa-solid fa-mug-saucer me-1"></i>Total de Produtos</div>
            <div class="stat-value">{{ $totalProdutos }}</div>
            <div style="font-size:0.78rem;color:#aaa;margin-top:0.4rem;">{{ $produtosAtivos }} disponíveis</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card vermelho">
            <div class="stat-label"><i class="fa-solid fa-receipt me-1"></i>Total de Pedidos</div>
            <div class="stat-value">{{ $totalPedidos }}</div>
            <div style="font-size:0.78rem;color:#aaa;margin-top:0.4rem;">{{ $pedidosPendentes }} pendentes</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card laranja">
            <div class="stat-label"><i class="fa-solid fa-fire me-1"></i>Em Preparo</div>
            <div class="stat-value">{{ $pedidosEmPreparo }}</div>
            <div style="font-size:0.78rem;color:#aaa;margin-top:0.4rem;">pedidos ativos agora</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card verde">
            <div class="stat-label"><i class="fa-solid fa-dollar-sign me-1"></i>Faturamento</div>
            <div class="stat-value" style="font-size:1.5rem;">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</div>
            <div style="font-size:0.78rem;color:#aaa;margin-top:0.4rem;">pedidos entregues/prontos</div>
        </div>
    </div>
</div>

{{-- Últimos Pedidos --}}
<div class="table-card">
    <div class="table-card-header">
        <h5><i class="fa-solid fa-clock-rotate-left me-2" style="color:var(--vermelho-express);"></i>Últimos Pedidos</h5>
        <a href="{{ route('admin.pedidos.index') }}" class="btn-java btn btn-sm">Ver todos</a>
    </div>

    @if($ultimosPedidos->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-receipt fa-2x mb-2 d-block"></i>Nenhum pedido ainda.
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($ultimosPedidos as $pedido)
                    @php
                        $cores = \App\Models\Pedido::statusColors();
                        $labels = \App\Models\Pedido::statusLabels();
                    @endphp
                    <tr>
                        <td class="px-4 py-3 text-muted">#{{ $pedido->id }}</td>
                        <td class="py-3 fw-500">{{ $pedido->cliente_nome }}</td>
                        <td class="py-3">{{ $pedido->produtos->count() }} item(ns)</td>
                        <td class="py-3 fw-600">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                        <td class="py-3">
                            <span class="badge bg-{{ $cores[$pedido->status] ?? 'secondary' }} rounded-pill px-3">
                                {{ $labels[$pedido->status] ?? $pedido->status }}
                            </span>
                        </td>
                        <td class="py-3 text-muted">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- Atalhos --}}
<div class="row g-3 mt-1">
    <div class="col-md-6">
        <a href="{{ route('admin.produtos.create') }}" class="text-decoration-none">
            <div style="background:#fff;border-radius:14px;padding:1.25rem 1.5rem;box-shadow:0 2px 12px rgba(41,31,115,0.07);display:flex;align-items:center;gap:1rem;transition:transform 0.18s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
                <div style="width:44px;height:44px;background:rgba(41,31,115,0.1);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-plus" style="color:var(--azul-java);font-size:1.1rem;"></i>
                </div>
                <div>
                    <div style="font-weight:600;color:var(--azul-java);">Novo Produto</div>
                    <div style="font-size:0.78rem;color:#999;">Adicionar ao cardápio</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('admin.pedidos.create') }}" class="text-decoration-none">
            <div style="background:#fff;border-radius:14px;padding:1.25rem 1.5rem;box-shadow:0 2px 12px rgba(41,31,115,0.07);display:flex;align-items:center;gap:1rem;transition:transform 0.18s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
                <div style="width:44px;height:44px;background:rgba(168,27,27,0.1);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-receipt" style="color:var(--vermelho-express);font-size:1.1rem;"></i>
                </div>
                <div>
                    <div style="font-weight:600;color:var(--vermelho-express);">Novo Pedido</div>
                    <div style="font-size:0.78rem;color:#999;">Registrar pedido de cliente</div>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection
