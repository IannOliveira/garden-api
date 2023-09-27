<?php

namespace App\Exceptions;

use Exception;

class UsuarioNaoEncontradoException extends Exception
{
    protected $message = 'Usuário não encontrado.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ]);
    }
}
