<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::with('produtos');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('busca')) {
            $query->where('cliente_nome', 'like', '%' . $request->busca . '%');
        }

        $pedidos = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $statusLabels = Pedido::statusLabels();
        $statusColors = Pedido::statusColors();

        return view('admin.pedidos.index', compact('pedidos', 'statusLabels', 'statusColors'));
    }

    public function create()
    {
        $produtos = Produto::where('disponivel', true)->orderBy('nome')->get();
        $statusLabels = Pedido::statusLabels();
        return view('admin.pedidos.create', compact('produtos', 'statusLabels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_nome'  => 'required|string|max:255',
            'cliente_email' => 'nullable|email|max:255',
            'status'        => 'required|in:' . implode(',', array_keys(Pedido::statusLabels())),
            'observacoes'   => 'nullable|string',
            'produtos'      => 'required|array|min:1',
            'produtos.*'    => 'exists:produtos,id',
            'quantidades'   => 'required|array',
            'quantidades.*' => 'integer|min:1',
        ]);

        $pedido = Pedido::create([
            'cliente_nome'  => $data['cliente_nome'],
            'cliente_email' => $data['cliente_email'] ?? null,
            'status'        => $data['status'],
            'observacoes'   => $data['observacoes'] ?? null,
            'total'         => 0,
        ]);

        $total = 0;
        foreach ($data['produtos'] as $index => $produtoId) {
            $produto    = Produto::findOrFail($produtoId);
            $quantidade = $data['quantidades'][$index] ?? 1;
            $subtotal   = $produto->preco * $quantidade;
            $total     += $subtotal;

            $pedido->produtos()->attach($produtoId, [
                'quantidade'     => $quantidade,
                'preco_unitario' => $produto->preco,
            ]);
        }

        $pedido->update(['total' => $total]);

        return redirect()->route('admin.pedidos.index')
            ->with('sucesso', 'Pedido criado com sucesso!');
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('produtos');
        $statusLabels = Pedido::statusLabels();
        $statusColors = Pedido::statusColors();
        return view('admin.pedidos.show', compact('pedido', 'statusLabels', 'statusColors'));
    }

    public function edit(Pedido $pedido)
    {
        $pedido->load('produtos');
        $produtos     = Produto::where('disponivel', true)->orderBy('nome')->get();
        $statusLabels = Pedido::statusLabels();
        return view('admin.pedidos.edit', compact('pedido', 'produtos', 'statusLabels'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'cliente_nome'  => 'required|string|max:255',
            'cliente_email' => 'nullable|email|max:255',
            'status'        => 'required|in:' . implode(',', array_keys(Pedido::statusLabels())),
            'observacoes'   => 'nullable|string',
            'produtos'      => 'required|array|min:1',
            'produtos.*'    => 'exists:produtos,id',
            'quantidades'   => 'required|array',
            'quantidades.*' => 'integer|min:1',
        ]);

        $pedido->update([
            'cliente_nome'  => $data['cliente_nome'],
            'cliente_email' => $data['cliente_email'] ?? null,
            'status'        => $data['status'],
            'observacoes'   => $data['observacoes'] ?? null,
        ]);

        $pedido->produtos()->detach();

        $total = 0;
        foreach ($data['produtos'] as $index => $produtoId) {
            $produto    = Produto::findOrFail($produtoId);
            $quantidade = $data['quantidades'][$index] ?? 1;
            $subtotal   = $produto->preco * $quantidade;
            $total     += $subtotal;

            $pedido->produtos()->attach($produtoId, [
                'quantidade'     => $quantidade,
                'preco_unitario' => $produto->preco,
            ]);
        }

        $pedido->update(['total' => $total]);

        return redirect()->route('admin.pedidos.index')
            ->with('sucesso', 'Pedido atualizado com sucesso!');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('admin.pedidos.index')
            ->with('sucesso', 'Pedido removido com sucesso!');
    }
}
