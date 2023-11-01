<?php

namespace App\Exceptions;

use Exception;

class ValorIgualAZeroException extends Exception
{
    protected $message = 'O Valor da conta nao pode ser zero ou vazio.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
