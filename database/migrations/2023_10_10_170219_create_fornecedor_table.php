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
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->id();
            $table->string('cpf_cnpj')->nullable();
            $table->string('inscricao_estadual')->nullable();
            $table->string('nome');
            $table->string('razao_social')->nullable();
            $table->string('endereco');
            $table->string('numero')->nullable();
            $table->string('cep')->nullable();
            $table->string('estado');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('telefone')->nullable();
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
        Schema::dropIfExists('fornecedor');
    }
};
