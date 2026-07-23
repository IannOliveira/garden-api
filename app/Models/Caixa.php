<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao', 'tipo', 'valor', 'forma_pagamento', 'data_lancamento',
        'faturamento_id', 'conta_receber_id', 'user_id'
    ];

    public function faturamento()
    {
        return $this->belongsTo(Faturamento::class);
    }

    public function contaReceber()
    {
        return $this->belongsTo(ContaReceber::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
