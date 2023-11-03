<?php

namespace App\Http\Controllers\Contas;

use App\Exceptions\DataPagamentoException;
use App\Exceptions\DataPagamentoMenorLancamentoException;
use App\Exceptions\DataVencimentoInvalidaException;
use App\Exceptions\DataVencimentoMenorQueAtualException;
use App\Exceptions\ValorIgualAZeroException;
use App\Exceptions\ValorPagoIgualException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Conta\ContasRequest;
use App\Http\Resources\ContasResource;
use App\Models\Contas;
use Carbon\Carbon;

class ContasController extends Controller
{
    public function __invoke()
    {

    }

    public function index(){
        $dataAtual = now();
        $dataAtual = $dataAtual->startOfDay();

        $verificaDataVencimento =  Contas::with('fornecedor')
            ->where('data_vencimento', '<', $dataAtual)
            ->whereNull('valor_pago')
            ->get();

        $verificaDataVencimento->each(function ($users) {
            $users->update(['status' => 2]);
        });

        $users = Contas::with('fornecedor')
            ->orderBy('status')
            ->orderBy('data_vencimento', 'ASC')
            ->get();

        return ContasResource::collection($users);
    }

    public function register(ContasRequest $request){
        $input = $request->validated();

        if ($input['valor'] == '0') {
            throw new ValorIgualAZeroException();
        }

        if(strtotime($input['data_vencimento']) === false){
            throw new DataVencimentoInvalidaException();
        }

        $dataVencimento = Carbon::parse($input['data_vencimento']);
        $dataAtual = now();

        $dataVencimento = $dataVencimento->startOfDay();
        $dataAtual = $dataAtual->startOfDay();

        if($dataVencimento->isBefore($dataAtual)){
            throw new DataVencimentoMenorQueAtualException();
        }

        $input['data_lancamento'] = $dataAtual;

        $input['status'] = 1;

        $user = Contas::query()->create($input);

        return new ContasResource($user);
    }

    public function payment(ContasRequest $request, $id){

        $user = Contas::findOrFail($id);

        $input = $request->validated();

        $dataPagamento = Carbon::parse($input['data_pagamento']);
        $dataPagamento = $dataPagamento->startOfDay();

        if($dataPagamento->isBefore($input['data_lancamento'])){
            throw new DataPagamentoMenorLancamentoException();
        }

        if($input['valor_pago'] < $input['valor'] || $input['valor_pago'] > $input['valor']) {
            throw new ValorPagoIgualException();
        }

        if(empty($input['data_pagamento'])){
            throw new DataPagamentoException();
        }

        $user->update(['status' => 3]);

        $user->fill($input);
        $user->save();

        return new ContasResource($user->fresh());
    }

    public function destroy($id){
        $user = Contas::where('id', $id);

        $user->delete();
    }

}
