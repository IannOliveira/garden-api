<?php

namespace App\Http\Requests\Conta;

use Illuminate\Foundation\Http\FormRequest;

class ContasRequest extends FormRequest
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
            'fornecedor_id' => 'integer|required',
            'numero_documento' => 'string|nullable',
            'nota_fiscal' => 'string|nullable',
            'valor' => 'numeric|required',
            'valor_pago' => 'numeric|nullable',
            'data_lancamento' => 'string',
            'data_vencimento' => 'string|required',
            'data_pagamento' => 'string|nullable',
            'tipo_pagamento' => 'string|required',
            'conta_movimento' => 'string|required',
            'plano_contas' => 'string|required',
            'status' => 'string',
        ];
    }
}
