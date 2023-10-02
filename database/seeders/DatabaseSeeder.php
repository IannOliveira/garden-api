<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cliente;
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
             'email' => 'ianncosta13@gmail.com',
             'pais' => 'Brasil',
             'estado' => 'Pará',
             'cidade' => 'Belém',
             'telefone' => '91982299542',
             'sexo' => 'Masculino',
             'estado_civil' => 'Solteiro',
         ]);

    }
}
