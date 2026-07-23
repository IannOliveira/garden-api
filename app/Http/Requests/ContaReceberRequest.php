<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaReceberRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data_pagamento' => 'required|date',
            'forma_pagamento' => 'required|string',
        ];
    }
}
