<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'string|required',
            'cpf' => 'string|required',
            'rg' => 'string|required',
            'endereco' => 'string|required',
            'numero_casa' => 'string|required',
            'bairro' => 'string|required',
            'cep' => 'string|nullable',
            'referencia' => 'string|nullable',
            'rede_social' => 'string|nullable',
            'pais' => 'string|required',
            'estado' => 'string|required',
            'cidade' => 'string|required',
            'telefone' => 'string|required',
            'sexo' => 'string|nullable',
            'estado_civil' => 'string|nullable',
        ];
    }
}
