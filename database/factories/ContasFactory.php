<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contas>
 */
class ContasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fornecedor_id' => fake(),
            'numero_documento' => fake(),
            'nota_fiscal' => fake(),
            'valor' => fake(),
            'valor_pago' => fake(),
            'data_lancamento' => fake()->date(now()),
            'data_vencimento' => fake(),
            'data_pagamento' => fake(),
            'tipo_pagamento' => fake(),
            'conta_movimento' => fake(),
            'plano_contas' => fake(),
            'status' => fake(),
        ];
    }
}
