<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FaturamentoResource extends JsonResource
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
            'cliente' => $this->whenLoaded('cliente'),
            'user' => $this->whenLoaded('user'),
            'tipo_pagamento' => $this->tipo_pagamento,
            'desconto' => (float) $this->desconto,
            'total' => (float) $this->total,
            'status' => $this->status,
            'observacao' => $this->observacao,
            'itens' => FaturamentoItemResource::collection($this->whenLoaded('itens')),
            'created_at' => $this->created_at,
        ];
    }
}
