<?php

namespace App\Exceptions;

use Exception;

class PrecoVendaProdutoException extends Exception
{
    protected $message = 'O Preço da Venda não pode ser zero ou vazio.';

    public function render(){
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}
