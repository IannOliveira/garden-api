<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaturamentoRequest;
use App\Http\Resources\FaturamentoResource;
use App\Models\Faturamento;
use App\Models\ContaReceber;
use App\Models\Produto;
use App\Models\Caixa;
use App\Models\FaturamentoCancelamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FaturamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $faturamentos = Faturamento::with(['cliente', 'user', 'itens.produto'])
            ->orderBy('id', 'desc')
            ->paginate(15);
        return FaturamentoResource::collection($faturamentos);
    }

    public function register(FaturamentoRequest $request)
    {
        $input = $request->validated();
        $user = Auth::user();

        DB::beginTransaction();

        try {
            $faturamento = Faturamento::create([
                'cliente_id' => $input['cliente_id'],
                'user_id' => $user->id,
                'tipo_pagamento' => $input['tipo_pagamento'],
                'desconto' => $input['desconto'] ?? 0,
                'total' => $input['total'],
                'observacao' => $input['observacao'] ?? null,
                'status' => 'concluido'
            ]);

            foreach ($input['itens'] as $item) {
                $produto = Produto::findOrFail($item['produto_id']);
                
                if ($produto->quantidade < $item['qty']) {
                    throw new \Exception("Estoque insuficiente para o produto {$produto->nome_produto}. Disponível: {$produto->quantidade}");
                }

                $faturamento->itens()->create([
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['qty'],
                    'preco_unitario' => $item['preco'],
                ]);

                $produto->quantidade -= $item['qty'];
                $produto->save();
            }

            // Criar as Contas a Receber
            $pagamentosAvista = ['DINHEIRO', 'PIX', 'CARTÃO DE DÉBITO'];
            $isAvista = in_array($input['tipo_pagamento'], $pagamentosAvista);

            if ($isAvista) {
                $conta = ContaReceber::create([
                    'faturamento_id' => $faturamento->id,
                    'cliente_id' => $input['cliente_id'],
                    'valor' => $input['total'],
                    'data_vencimento' => now(),
                    'data_pagamento' => now(),
                    'status' => 'pago',
                    'forma_pagamento' => $input['tipo_pagamento'],
                ]);

                // Lançar no caixa automaticamente
                Caixa::create([
                    'descricao' => 'Venda #' . $faturamento->id . ' - ' . $input['tipo_pagamento'],
                    'tipo' => 'entrada',
                    'valor' => $input['total'],
                    'forma_pagamento' => $input['tipo_pagamento'],
                    'data_lancamento' => now(),
                    'faturamento_id' => $faturamento->id,
                    'conta_receber_id' => $conta->id,
                    'user_id' => $user->id,
                ]);
            } else {
                // A Prazo / Boleto / Cartão de Crédito
                if (isset($input['parcelas']) && count($input['parcelas']) > 0) {
                    foreach ($input['parcelas'] as $parcela) {
                        ContaReceber::create([
                            'faturamento_id' => $faturamento->id,
                            'cliente_id' => $input['cliente_id'],
                            'valor' => $parcela['valor'],
                            'data_vencimento' => $parcela['data_vencimento'],
                            'data_pagamento' => null,
                            'status' => 'pendente',
                            'forma_pagamento' => $input['tipo_pagamento'],
                        ]);
                    }
                } else {
                    // Fallback se não enviou parcelas
                    ContaReceber::create([
                        'faturamento_id' => $faturamento->id,
                        'cliente_id' => $input['cliente_id'],
                        'valor' => $input['total'],
                        'data_vencimento' => now()->addDays(30),
                        'data_pagamento' => null,
                        'status' => 'pendente',
                        'forma_pagamento' => $input['tipo_pagamento'],
                    ]);
                }
            }

            DB::commit();

            $faturamento->load(['cliente', 'user', 'itens.produto']);

            return new FaturamentoResource($faturamento);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao processar faturamento: ' . $e->getMessage()], 422);
        }
    }

    public function destroy($id)
    {
        $faturamento = Faturamento::with('itens')->findOrFail($id);
        $user = Auth::user();

        if ($faturamento->status === 'cancelado' || $faturamento->status === 'estornado') {
            return response()->json(['message' => 'Faturamento já está estornado.'], 400);
        }

        DB::beginTransaction();
        try {
            // Estornar Estoque
            foreach ($faturamento->itens as $item) {
                $produto = Produto::findOrFail($item->produto_id);
                $produto->quantidade += $item->quantidade;
                $produto->save();
            }

            // Mudar status do faturamento
            $faturamento->status = 'estornado';
            $faturamento->save();

            // Cancelar Contas a Receber pendentes
            ContaReceber::where('faturamento_id', $faturamento->id)
                ->where('status', '!=', 'pago')
                ->update(['status' => 'cancelado']);

            // Se houve lançamento no caixa, criar lançamento de saída (estorno)
            $caixas = Caixa::where('faturamento_id', $faturamento->id)->get();
            foreach ($caixas as $caixa) {
                Caixa::create([
                    'descricao' => 'Estorno Venda #' . $faturamento->id,
                    'tipo' => 'saida',
                    'valor' => $caixa->valor,
                    'forma_pagamento' => $caixa->forma_pagamento,
                    'data_lancamento' => now(),
                    'faturamento_id' => $faturamento->id,
                    'user_id' => $user->id,
                ]);
            }

            FaturamentoCancelamento::create([
                'faturamento_id' => $faturamento->id,
                'user_id' => $user->id,
                'motivo' => request('motivo', 'Cancelamento padrão')
            ]);

            DB::commit();

            return response()->json(['message' => 'Faturamento cancelado com sucesso.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao cancelar faturamento: ' . $e->getMessage()], 500);
        }
    }
}
