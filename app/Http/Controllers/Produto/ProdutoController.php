<?php

namespace App\Http\Controllers\Produto;

use App\Exceptions\PrecoProdutoException;
use App\Exceptions\PrecoVendaProdutoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Produto\ProdutoRequest;
use App\Http\Resources\Produto\ProdutoResource;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $users = Produto::orderBy('categoria')
            ->orderBy('nome_produto', 'ASC')
            ->get();

        return ProdutoResource::collection($users);
    }

    public function register(ProdutoRequest $request)
    {
        $input = $request->validated();

        if ($input['preco'] == '0') {
            throw new PrecoProdutoException();
        }

        if ($input['preco_venda'] == '0') {
            throw new PrecoVendaProdutoException();
        }

        $user = Produto::query()->create($input);

        return new ProdutoResource($user);
    }

    public function update(ProdutoRequest $request, $id)
    {
        $input = $request->validated();

        $user = Produto::findOrFail($id);

        if ($input['preco'] == '0') {
            throw new PrecoProdutoException();
        }

        if ($input['preco_venda'] == '0') {
            throw new PrecoVendaProdutoException();
        }

        $user->fill($input);
        $user->save();

        return new ProdutoResource($user->fresh());
    }


}
