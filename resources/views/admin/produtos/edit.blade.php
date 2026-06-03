@extends('layouts.admin')
@section('title', 'Editar Produto')
@section('page-title', 'Editar Produto')

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.produtos.index') }}" style="color:var(--azul-java);text-decoration:none;font-size:0.88rem;">
        <i class="fa-solid fa-arrow-left me-1"></i>Voltar para Produtos
    </a>
</div>

<div class="form-card" style="max-width:680px;">
    <h5 class="mb-4" style="color:var(--azul-java);font-weight:700;">
        <i class="fa-solid fa-pen me-2" style="color:var(--vermelho-express);"></i>Editar: {{ $produto->nome }}
    </h5>

    @if($errors->any())
        <div class="alert alert-danger rounded-3 mb-3">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li style="font-size:0.85rem;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.produtos.update', $produto) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome do Produto <span class="text-danger">*</span></label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $produto->nome) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="3">{{ old('descricao', $produto->descricao) }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Preço (R$) <span class="text-danger">*</span></label>
                <input type="number" name="preco" class="form-control" value="{{ old('preco', $produto->preco) }}" required step="0.01" min="0">
            </div>
            <div class="col-md-6">
                <label class="form-label">Categoria <span class="text-danger">*</span></label>
                <select name="categoria" class="form-select" required>
                    @foreach($categorias as $key => $label)
                        <option value="{{ $key }}" {{ old('categoria', $produto->categoria) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">URL da Imagem</label>
            <input type="url" name="imagem_url" class="form-control" value="{{ old('imagem_url', $produto->imagem_url) }}" placeholder="https://...">
        </div>

        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="disponivel" id="disponivel"
                       {{ old('disponivel', $produto->disponivel) ? 'checked' : '' }}>
                <label class="form-check-label" for="disponivel" style="font-size:0.88rem;">
                    Produto disponível no cardápio
                </label>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-express px-4">
                <i class="fa-solid fa-floppy-disk me-2"></i>Atualizar Produto
            </button>
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary px-4" style="border-radius:50px;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
