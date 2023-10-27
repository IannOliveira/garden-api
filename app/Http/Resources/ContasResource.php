<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fornecedor_id' => $this->fornecedor_id,
            'numero_documento' => $this->numero_documento,
            'nota_fiscal' => $this->nota_fiscal,
            'valor' => $this->valor,
            'valor_pago' => $this->valor_pago,
            'data_lancamento' => $this->data_lancamento,
            'data_vencimento' => $this->data_vencimento,
            'data_pagamento' => $this->data_pagamento,
            'tipo_pagamento' => $this->tipo_pagamento,
            'conta_movimento' => $this->conta_movimento,
            'plano_contas' => $this->plano_contas,
            'status' => $this->status,
            'fornecedor_nome' => $this->fornecedor->nome,
        ];
    }
}
