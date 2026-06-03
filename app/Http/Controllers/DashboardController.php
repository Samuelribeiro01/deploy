<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutos    = Produto::count();
        $produtosAtivos   = Produto::where('disponivel', true)->count();
        $totalPedidos     = Pedido::count();
        $pedidosPendentes = Pedido::where('status', 'pendente')->count();
        $pedidosEmPreparo = Pedido::where('status', 'em_preparo')->count();
        $faturamentoTotal = Pedido::whereIn('status', ['pronto', 'entregue'])->sum('total');

        $ultimosPedidos = Pedido::with('produtos')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProdutos',
            'produtosAtivos',
            'totalPedidos',
            'pedidosPendentes',
            'pedidosEmPreparo',
            'faturamentoTotal',
            'ultimosPedidos'
        ));
    }
}
