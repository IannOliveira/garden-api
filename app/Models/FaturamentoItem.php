<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaturamentoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'faturamento_id', 'produto_id', 'quantidade', 'preco_unitario'
    ];

    public function faturamento()
    {
        return $this->belongsTo(Faturamento::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
