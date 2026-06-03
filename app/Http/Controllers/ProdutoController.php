<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::query();

        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $produtos = $query->orderBy('nome')->paginate(10)->withQueryString();

        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Produto::categorias();
        return view('admin.produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'       => 'required|string|max:255',
            'descricao'  => 'nullable|string',
            'preco'      => 'required|numeric|min:0',
            'categoria'  => 'required|in:' . implode(',', array_keys(Produto::categorias())),
            'imagem_url' => 'nullable|url|max:500',
            'disponivel' => 'nullable|boolean',
        ]);

        $data['disponivel'] = $request->has('disponivel');

        Produto::create($data);

        return redirect()->route('admin.produtos.index')
            ->with('sucesso', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('admin.produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias = Produto::categorias();
        return view('admin.produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome'       => 'required|string|max:255',
            'descricao'  => 'nullable|string',
            'preco'      => 'required|numeric|min:0',
            'categoria'  => 'required|in:' . implode(',', array_keys(Produto::categorias())),
            'imagem_url' => 'nullable|url|max:500',
            'disponivel' => 'nullable|boolean',
        ]);

        $data['disponivel'] = $request->has('disponivel');

        $produto->update($data);

        return redirect()->route('admin.produtos.index')
            ->with('sucesso', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('admin.produtos.index')
            ->with('sucesso', 'Produto removido com sucesso!');
    }
}
