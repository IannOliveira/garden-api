<?php

namespace App\Exceptions;

use Exception;

class DataPagamentoMenorLancamentoException extends Exception
{
    protected $message = 'A Data de Pagamento não pode ser menor que a Data de Lançamento.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
