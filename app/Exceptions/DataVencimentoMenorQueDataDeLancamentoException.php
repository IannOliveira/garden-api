<?php

namespace App\Exceptions;

use Exception;

class DataVencimentoMenorQueDataDeLancamentoException extends Exception
{
    protected $message = 'A data de vencimento não pode ser menor que a data de lançamento.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
