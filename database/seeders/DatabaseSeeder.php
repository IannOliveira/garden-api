<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

    }
}
