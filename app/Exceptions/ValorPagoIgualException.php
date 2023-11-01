<?php

namespace App\Exceptions;

use Exception;

class ValorPagoIgualException extends Exception
{
    protected $message = 'O Valor Pago tem que ser igual ao Valor.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
