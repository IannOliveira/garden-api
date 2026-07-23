<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaturamentoCancelamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'faturamento_id', 'user_id', 'motivo'
    ];

    public function faturamento()
    {
        return $this->belongsTo(Faturamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
