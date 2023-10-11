<?php

namespace App\Http\Requests\Fornecedor;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
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
            'cpf_cnpj' => 'string|nullable',
            'inscricao_estadual' => 'string|nullable',
            'nome' => 'string|required',
            'razao_social' => 'string|required',
            'endereco' => 'string|nullable',
            'numero' => 'string|nullable',
            'cep' => 'string|nullable',
            'estado' => 'string|nullable',
            'cidade' => 'string|nullable',
            'bairro' => 'string|nullable',
            'telefone' => 'string|nullable',
        ];
    }
}
