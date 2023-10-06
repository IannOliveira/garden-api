<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->string('endereco');
            $table->string('numero_casa');
            $table->string('bairro');
            $table->string('cep')->nullable();
            $table->string('referencia')->nullable();
            $table->string('email')->unique();
            $table->string('pais');
            $table->string('estado');
            $table->string('cidade');
            $table->string('telefone');
            $table->string('sexo')->nullable();
            $table->string('estado_civil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
