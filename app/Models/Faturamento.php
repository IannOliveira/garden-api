<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faturamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'user_id', 'tipo_pagamento', 'desconto', 'total', 'observacao'
    ];

    public function itens()
    {
        return $this->hasMany(FaturamentoItem::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
