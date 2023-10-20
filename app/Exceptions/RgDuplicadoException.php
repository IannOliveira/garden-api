<?php

namespace App\Exceptions;

use Exception;

class RgDuplicadoException extends Exception
{
    protected $message = 'RG existente, informe outro RG.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
