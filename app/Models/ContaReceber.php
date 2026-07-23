<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    use HasFactory;

    protected $fillable = [
        'faturamento_id', 'cliente_id', 'valor', 'data_vencimento', 'data_pagamento', 'status', 'forma_pagamento'
    ];

    public function faturamento()
    {
        return $this->belongsTo(Faturamento::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
