<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'categoria',
        'imagem_url',
        'disponivel',
    ];

    protected $casts = [
        'preco'      => 'decimal:2',
        'disponivel' => 'boolean',
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_produto')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }

    public static function categorias(): array
    {
        return [
            'espresso'   => 'Espresso',
            'cappuccino' => 'Cappuccino',
            'cold_brew'  => 'Cold Brew',
            'chá'        => 'Chá',
            'suco'       => 'Suco',
            'lanche'     => 'Lanche',
            'sobremesa'  => 'Sobremesa',
            'outro'      => 'Outro',
        ];
    }
}
