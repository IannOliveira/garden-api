<?php

namespace App\Exceptions;

use Exception;

class DataPagamentoException extends Exception
{
    protected $message = 'Insira a Data de Pagamento.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
