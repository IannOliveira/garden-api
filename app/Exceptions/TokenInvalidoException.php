<?php

namespace App\Exceptions;

use Exception;

class TokenInvalidoException extends Exception
{
    protected $message = 'Token inválido.';

    public function render(){
        return reponse()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
