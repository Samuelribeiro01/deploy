@extends('layouts.admin')
@section('title', 'Novo Pedido')
@section('page-title', 'Novo Pedido')

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.pedidos.index') }}" style="color:var(--azul-java);text-decoration:none;font-size:0.88rem;">
        <i class="fa-solid fa-arrow-left me-1"></i>Voltar para Pedidos
    </a>
</div>

<div class="form-card" style="max-width:780px;">
    <h5 class="mb-4" style="color:var(--azul-java);font-weight:700;">
        <i class="fa-solid fa-receipt me-2" style="color:var(--vermelho-express);"></i>Registrar Novo Pedido
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

    <form method="POST" action="{{ route('admin.pedidos.store') }}" id="pedido-form">
        @csrf

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Nome do Cliente <span class="text-danger">*</span></label>
                <input type="text" name="cliente_nome" class="form-control" value="{{ old('cliente_nome') }}" required placeholder="Nome completo">
            </div>
            <div class="col-md-6">
                <label class="form-label">E-mail do Cliente</label>
                <input type="email" name="cliente_email" class="form-control" value="{{ old('cliente_email') }}" placeholder="email@exemplo.com">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select name="status" class="form-select" required>
                @foreach($statusLabels as $key => $label)
                    <option value="{{ $key }}" {{ old('status', 'pendente') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- Seletor de Produtos --}}
        <div class="mb-3">
            <label class="form-label">Produtos do Pedido <span class="text-danger">*</span></label>
            <div id="itens-container">
                <div class="item-linha row g-2 mb-2 align-items-center">
                    <div class="col-7">
                        <select name="produtos[]" class="form-select produto-select" required>
                            <option value="">Selecione um produto...</option>
                            @foreach($produtos as $p)
                                <option value="{{ $p->id }}" data-preco="{{ $p->preco }}">
                                    {{ $p->nome }} — R$ {{ number_format($p->preco, 2, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="number" name="quantidades[]" class="form-control qtd-input" value="1" min="1" placeholder="Qtd">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-sm btn-express w-100 remover-item" title="Remover">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" id="add-item" class="btn btn-sm btn-java mt-1">
                <i class="fa-solid fa-plus me-1"></i>Adicionar item
            </button>
        </div>

        {{-- Total estimado --}}
        <div class="mb-3 p-3 rounded-3" style="background:#f3f0eb;">
            <div style="font-size:0.85rem;color:#888;">Total estimado:</div>
            <div id="total-display" style="font-size:1.4rem;font-weight:700;color:var(--azul-java);">R$ 0,00</div>
        </div>

        <div class="mb-4">
            <label class="form-label">Observações</label>
            <textarea name="observacoes" class="form-control" rows="2" placeholder="Ex: Sem açúcar, mesa 5...">{{ old('observacoes') }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-express px-4">
                <i class="fa-solid fa-floppy-disk me-2"></i>Salvar Pedido
            </button>
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-outline-secondary px-4" style="border-radius:50px;">
                Cancelar
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
const produtosData = @json($produtos->map(fn($p) => ['id' => $p->id, 'nome' => $p->nome, 'preco' => (float)$p->preco]));

function linhaHTML() {
    const options = produtosData.map(p =>
        `<option value="${p.id}" data-preco="${p.preco}">${p.nome} — R$ ${p.preco.toFixed(2).replace('.',',')}</option>`
    ).join('');
    return `
    <div class="item-linha row g-2 mb-2 align-items-center">
        <div class="col-7">
            <select name="produtos[]" class="form-select produto-select" required>
                <option value="">Selecione um produto...</option>
                ${options}
            </select>
        </div>
        <div class="col-3">
            <input type="number" name="quantidades[]" class="form-control qtd-input" value="1" min="1">
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-sm btn-express w-100 remover-item">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </div>`;
}

function calcTotal() {
    let total = 0;
    document.querySelectorAll('.item-linha').forEach(linha => {
        const sel = linha.querySelector('.produto-select');
        const qtd = parseInt(linha.querySelector('.qtd-input').value) || 0;
        const preco = parseFloat(sel.selectedOptions[0]?.dataset.preco || 0);
        total += preco * qtd;
    });
    document.getElementById('total-display').textContent =
        'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

document.getElementById('add-item').addEventListener('click', () => {
    document.getElementById('itens-container').insertAdjacentHTML('beforeend', linhaHTML());
    bindEvents();
});

function bindEvents() {
    document.querySelectorAll('.remover-item').forEach(btn => {
        btn.onclick = function() {
            if (document.querySelectorAll('.item-linha').length > 1) {
                this.closest('.item-linha').remove();
                calcTotal();
            }
        };
    });
    document.querySelectorAll('.produto-select, .qtd-input').forEach(el => {
        el.oninput = calcTotal;
    });
}

bindEvents();
</script>
@endpush
@endsection
