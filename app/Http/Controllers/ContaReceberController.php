<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaReceber;
use App\Models\Caixa;
use App\Http\Requests\ContaReceberRequest;
use App\Http\Resources\ContaReceberResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContaReceberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $query = ContaReceber::with('cliente');

        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->cliente_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('data_inicio')) {
            $query->where('data_vencimento', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->where('data_vencimento', '<=', $request->data_fim);
        }

        $contas = $query->orderByRaw("FIELD(status, 'pendente', 'pago', 'cancelado')")
            ->orderBy('data_vencimento', 'ASC')
            ->get();
            
        return ContaReceberResource::collection($contas);
    }

    public function payment(ContaReceberRequest $request, $id)
    {
        $conta = ContaReceber::findOrFail($id);
        $input = $request->validated();
        $user = Auth::user();

        if ($conta->status === 'pago') {
            return response()->json(['message' => 'Conta já está paga'], 400);
        }
        if ($conta->status === 'cancelado') {
            return response()->json(['message' => 'Conta está cancelada'], 400);
        }

        DB::beginTransaction();

        try {
            $conta->status = 'pago';
            $conta->data_pagamento = $input['data_pagamento'];
            $conta->forma_pagamento = $input['forma_pagamento'];
            $conta->save();

            // Lançar no caixa
            Caixa::create([
                'descricao' => 'Recebimento de Parcela #' . $conta->id . ($conta->faturamento_id ? ' Venda #' . $conta->faturamento_id : ''),
                'tipo' => 'entrada',
                'valor' => $conta->valor,
                'forma_pagamento' => $input['forma_pagamento'],
                'data_lancamento' => $input['data_pagamento'],
                'faturamento_id' => $conta->faturamento_id,
                'conta_receber_id' => $conta->id,
                'user_id' => $user->id,
            ]);

            DB::commit();

            return new ContaReceberResource($conta->fresh('cliente'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao processar pagamento: ' . $e->getMessage()], 500);
        }
    }
}
