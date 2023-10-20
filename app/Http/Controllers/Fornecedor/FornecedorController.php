<?php

namespace App\Http\Controllers\Fornecedor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fornecedor\FornecedorRequest;
use App\Http\Resources\Fornecedor\FornecedorResource;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

    public function index(){

        $users = Fornecedor::all();

        return FornecedorResource::collection($users);

    }

    public function register(FornecedorRequest $request){

        $input = $request->validated();

        $user = Fornecedor::query()->create($input);

        return new FornecedorResource($user);

    }

    public function update(FornecedorRequest $request, $id){

        $user = Fornecedor::findOrFail($id);

        $input = $request->validated();

        $user->fill($input);
        $user->save();

        return new FornecedorResource($user->fresh());
    }

    public function destroy($id){

        $user = Fornecedor::where('id', $id);

        $user->delete();
    }

}
