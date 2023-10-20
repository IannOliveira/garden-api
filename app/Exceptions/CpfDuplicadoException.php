<?php

namespace App\Exceptions;

use Exception;

class CpfDuplicadoException extends Exception
{
    protected $message = 'CPF existente, informe outro CPF.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
