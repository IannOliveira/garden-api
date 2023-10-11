<?php

namespace App\Http\Resources\Fornecedor;

use Illuminate\Http\Resources\Json\JsonResource;

class FornecedorResource extends JsonResource
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
            'cpf_cnpj' => $this->cpf_cnpj,
            'incricao_estadual' => $this->incricao_estadual,
            'nome' => $this->nome,
            'razao_social' => $this->razao_social,
            'endereco' => $this->endereco,
            'numero' => $this->numero,
            'cep' => $this->cep,
            'estado' => $this->estado,
            'cidade' => $this->cidade,
            'bairro' => $this->bairro,
            'telefone' => $this->telefone
        ];
    }
}
