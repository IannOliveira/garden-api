<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome_produto' => fake(),
            'descricao' => fake(),
            'categoria' => fake(),
            'fabricante' => fake(),
            'preco' => fake(),
            'preco_venda' => fake(),
        ];
    }
}
