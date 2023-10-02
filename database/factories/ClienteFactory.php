<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => fake(),
            'cpf' => fake()->unique(null, 1),
            'rg' => fake()->unique(null, 1),
            'endereco' => fake(),
            'numero_casa' => fake(),
            'bairro' => fake(),
            'cep' => fake(),
            'referencia' => fake(),
            'email' => fake()->safeEmail(),
            'pais' => fake(),
            'estado' => fake(),
            'cidade' => fake(),
            'telefone' => fake(),
            'sexo' => fake(),
            'estado_civil' => fake(),
        ];
    }
}
