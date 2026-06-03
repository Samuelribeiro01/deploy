<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Produto;
use App\Models\Pedido;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@javaexpress.com'],
            [
                'name'     => 'Admin Java Express',
                'password' => Hash::make('admin123'),
            ]
        );

        // Produtos
        $produtos = [
            ['nome' => 'Espresso Duplo',    'descricao' => 'Dose dupla de puro grão, sem distrações.',                         'preco' => 9.90,  'categoria' => 'espresso',   'imagem_url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=600', 'disponivel' => true],
            ['nome' => 'Cappuccino Dev',    'descricao' => 'Leite vaporizado, espuma perfeita e um toque de canela.',           'preco' => 14.90, 'categoria' => 'cappuccino', 'imagem_url' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?q=80&w=600', 'disponivel' => true],
            ['nome' => 'Cold Brew Nitro',   'descricao' => '18h de extração a frio com gás nitrogênio.',                       'preco' => 19.90, 'categoria' => 'cold_brew',  'imagem_url' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?q=80&w=600', 'disponivel' => true],
            ['nome' => 'Latte Macchiato',   'descricao' => 'Camadas de leite vaporizado e espresso. Visual impecável.',        'preco' => 16.90, 'categoria' => 'cappuccino', 'imagem_url' => null, 'disponivel' => true],
            ['nome' => 'Croissant Integral','descricao' => 'Crocante por fora, macio por dentro. Par perfeito com o café.',    'preco' => 12.00, 'categoria' => 'lanche',     'imagem_url' => null, 'disponivel' => true],
            ['nome' => 'Chá Verde Gelado',  'descricao' => 'Refrescante e cheio de antioxidantes para manter o foco.',        'preco' => 11.00, 'categoria' => 'outro',        'imagem_url' => null, 'disponivel' => false],
        ];

        foreach ($produtos as $p) {
            Produto::firstOrCreate(['nome' => $p['nome']], $p);
        }

        // Pedidos de exemplo
        $prod1 = Produto::where('nome', 'Espresso Duplo')->first();
        $prod2 = Produto::where('nome', 'Cappuccino Dev')->first();
        $prod3 = Produto::where('nome', 'Cold Brew Nitro')->first();

        if ($prod1 && $prod2 && Pedido::count() === 0) {
            $pedido1 = Pedido::create([
                'cliente_nome'  => 'João Silva',
                'cliente_email' => 'joao@email.com',
                'status'        => 'entregue',
                'total'         => ($prod1->preco * 2) + $prod2->preco,
                'observacoes'   => 'Sem açúcar no cappuccino.',
            ]);
            $pedido1->produtos()->attach($prod1->id, ['quantidade' => 2, 'preco_unitario' => $prod1->preco]);
            $pedido1->produtos()->attach($prod2->id, ['quantidade' => 1, 'preco_unitario' => $prod2->preco]);

            $pedido2 = Pedido::create([
                'cliente_nome'  => 'Maria Dev',
                'cliente_email' => 'maria@email.com',
                'status'        => 'em_preparo',
                'total'         => $prod3->preco,
                'observacoes'   => null,
            ]);
            $pedido2->produtos()->attach($prod3->id, ['quantidade' => 1, 'preco_unitario' => $prod3->preco]);

            $pedido3 = Pedido::create([
                'cliente_nome'  => 'Carlos Backend',
                'cliente_email' => null,
                'status'        => 'pendente',
                'total'         => $prod1->preco + $prod2->preco,
                'observacoes'   => 'Mesa 7.',
            ]);
            $pedido3->produtos()->attach($prod1->id, ['quantidade' => 1, 'preco_unitario' => $prod1->preco]);
            $pedido3->produtos()->attach($prod2->id, ['quantidade' => 1, 'preco_unitario' => $prod2->preco]);
        }
    }
}
