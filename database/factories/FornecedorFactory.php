<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cpf_cnpj' => fake(),
            'inscricao_estadual' => fake(),
            'nome' => fake(),
            'razao_social' => fake(),
            'endereco' => fake(),
            'numero' => fake(),
            'cep' => fake(),
            'estado' => fake(),
            'cidade' => fake(),
            'bairro' => fake(),
            'telefone' => fake(),
            ];
    }
}
