<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContaReceberResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'faturamento_id' => $this->faturamento_id,
            'cliente' => [
                'id' => $this->cliente?->id ?? null,
                'nome' => $this->cliente?->nome ?? 'Cliente não encontrado',
                'endereco' => $this->cliente?->endereco ?? null,
                'numero_casa' => $this->cliente?->numero_casa ?? null,
                'cidade' => $this->cliente?->cidade ?? null,
                'estado' => $this->cliente?->estado ?? null,
                'telefone' => $this->cliente?->telefone ?? null,
            ],
            'valor' => $this->valor,
            'data_vencimento' => $this->data_vencimento,
            'data_pagamento' => $this->data_pagamento,
            'status' => $this->status,
            'forma_pagamento' => $this->forma_pagamento,
        ];
    }
}
