<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FaturamentoItemResource extends JsonResource
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
            'faturamento_id' => $this->faturamento_id,
            'produto' => $this->whenLoaded('produto'),
            'quantidade' => $this->quantidade,
            'preco_unitario' => (float) $this->preco_unitario,
        ];
    }
}
