<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cliente;
use App\Models\Fornecedor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'token' => Str::uuid(),
             'primeiro_nome' => 'Iann',
             'sobrenome' => 'Oliveira',
             'email' => 'iann_costa@hotmail.com',
         ]);

         Cliente::factory()->create([
             'nome' => 'Iann Oliveira Costa',
             'cpf' => '11111111111',
             'rg' => '6666666',
             'endereco' => 'Av. Marques de Herval',
             'numero_casa' => '2490',
             'bairro' => 'PEdreira',
             'cep' => '6654620',
             'referencia' => 'Test',
             'rede_social' => 'iannoliveira_',
             'pais' => 'Brasil',
             'estado' => 'Pará',
             'cidade' => 'Belém',
             'telefone' => '91982299542',
             'sexo' => 'Masculino',
             'estado_civil' => 'Solteiro',
         ]);

         Fornecedor::factory()->create([
             'cpf_cnpj' => '11111111111',
             'inscricao_estadual' => 'Testando Inscrição',
             'nome' => 'Farma Lider',
             'razao_social' => 'Farmacia Lider',
             'endereco' => 'Avenida Pedro Miranda',
             'numero' => '246',
             'cep' => '6654620',
             'estado' => 'TO',
             'cidade' => 'Abaetetuba',
             'bairro' => 'Pedreira',
             'telefone' => '91982299542',
         ]);

         \App\Models\Contas::factory()->create([
            'fornecedor_id' => '1',
             'numero_documento' => '123123',
             'nota_fiscal' => 'ADSADA123',
             'valor' => '10.20',
             'valor_pago' => '30.30',
             'data_lancamento' => '2023/10/14',
             'data_vencimento' => '2023/10/29',
             'data_pagamento' => '2023/10/17',
             'tipo_pagamento' => 'Dinheiro',
             'conta_movimento' => 'CAIXA',
             'plano_contas' => 'Vale Transporte',
         ]);

    }
}
