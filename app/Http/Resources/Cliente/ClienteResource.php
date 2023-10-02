<?php

namespace App\Http\Resources\Cliente;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'endereco' => $this->endereco,
            'numero_casa' => $this->numero_casa,
            'bairro' => $this->bairro,
            'cep' => $this->cep,
            'referencia' => $this->referencia,
            'email' => $this->email,
            'pais' => $this->pais,
            'estado' => $this->estado,
            'cidade' => $this->cidade,
            'telefone' => $this->telefone,
            'sexo' => $this->sexo,
            'estado_civil' => $this->estado_civil,
        ];
    }
}
