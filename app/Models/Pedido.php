<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_nome',
        'cliente_email',
        'status',
        'total',
        'observacoes',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'pedido_produto')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }

    public static function statusLabels(): array
    {
        return [
            'pendente'   => 'Pendente',
            'em_preparo' => 'Em Preparo',
            'pronto'     => 'Pronto',
            'entregue'   => 'Entregue',
            'cancelado'  => 'Cancelado',
        ];
    }

    public static function statusColors(): array
    {
        return [
            'pendente'   => 'warning',
            'em_preparo' => 'info',
            'pronto'     => 'success',
            'entregue'   => 'secondary',
            'cancelado'  => 'danger',
        ];
    }
}
