<?php

namespace App\Http\Resources\Produto;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
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
            'nome_produto' => $this->nome_produto,
            'descricao' => $this->descricao,
            'categoria' => $this->categoria,
            'fabricante' => $this->fabricante,
            'preco' => $this->preco,
            'preco_venda' => $this->preco_venda,
        ];
    }
}
