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
        Schema::create('contas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('fornecedor_id')->constrained('fornecedor')->onDelete('CASCADE')->onUpdate('CASCADE');
                $table->string('numero_documento')->nullable();
                $table->string('nota_fiscal')->nullable();
                $table->string('valor');
                $table->string('valor_pago')->nullable();
                $table->date('data_lancamento')->nullable();
                $table->date('data_vencimento');
                $table->date('data_pagamento')->nullable();
                $table->string('tipo_pagamento');
                $table->string('conta_movimento');
                $table->string('plano_contas');
                $table->string('status');
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
        Schema::dropIfExists('contas');
    }
};
