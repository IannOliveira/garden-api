<?php

namespace App\Exceptions;

use Exception;

class EmailVerificadoException extends Exception
{
    protected $message = 'Email já verificado.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ]);
    }

}
