<?php

namespace App\Exceptions;

use Exception;

class DataVencimentoInvalidaException extends Exception
{
    protected $message = 'A data de vencimento é inválida.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
