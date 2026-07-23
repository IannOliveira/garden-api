<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaturamentoRequest extends FormRequest
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
            'cliente_id' => 'required|exists:cliente,id',
            'tipo_pagamento' => 'required|string',
            'desconto' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'observacao' => 'nullable|string',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produto,id',
            'itens.*.qty' => 'required|integer|min:1',
            'itens.*.preco' => 'required|numeric|min:0',
            'parcelas' => 'nullable|array',
            'parcelas.*.data_vencimento' => 'required_with:parcelas|date',
            'parcelas.*.valor' => 'required_with:parcelas|numeric|min:0',
        ];
    }
}
