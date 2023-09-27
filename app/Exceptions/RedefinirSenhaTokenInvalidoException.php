<?php

namespace App\Exceptions;

use Exception;

class RedefinirSenhaTokenInvalidoException extends Exception
{
    protected $message = 'O token de resetar senha está inválido.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ]);
    }
}
