<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use Illuminate\Http\Request;

class CaixaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        // Pega todos os lançamentos de caixa
        $lancamentos = Caixa::orderBy('data_lancamento', 'desc')
                            ->orderBy('id', 'desc')
                            ->get();

        // Calcular totais separados
        $entradasDinheiroPixBoleto = 0;
        $entradasCartao = 0;
        $saidas = 0;

        foreach ($lancamentos as $l) {
            if ($l->tipo === 'entrada') {
                if (in_array($l->forma_pagamento, ['CARTÃO DE CRÉDITO', 'CARTÃO DE DÉBITO'])) {
                    $entradasCartao += $l->valor;
                } else {
                    $entradasDinheiroPixBoleto += $l->valor;
                }
            } else {
                $saidas += $l->valor;
            }
        }

        $saldoGeral = ($entradasDinheiroPixBoleto + $entradasCartao) - $saidas;

        return response()->json([
            'resumo' => [
                'entradas_cartao' => $entradasCartao,
                'entradas_outros' => $entradasDinheiroPixBoleto,
                'saidas' => $saidas,
                'saldo_geral' => $saldoGeral,
            ],
            'lancamentos' => $lancamentos
        ]);
    }
}
