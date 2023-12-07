<?php

namespace App\Http\Controllers\Produto;

use App\Exceptions\PrecoProdutoException;
use App\Exceptions\PrecoVendaProdutoException;
use App\Exceptions\ValorIgualAZeroException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Produto\ProdutoRequest;
use App\Http\Resources\Produto\ProdutoResource;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

    public function index(){
        $users = Produto::all();

        return ProdutoResource::collection($users);
    }

    public function register(ProdutoRequest $request){
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

    public function update(ProdutoRequest $request, $id){
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
