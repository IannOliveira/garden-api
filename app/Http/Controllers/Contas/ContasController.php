<?php

namespace App\Http\Controllers\Contas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Conta\ContasRequest;
use App\Http\Resources\ContasResource;
use App\Models\Contas;

class ContasController extends Controller
{
    public function __invoke()
    {

    }

    public function index(){
        $users = Contas::with('fornecedor')->get();

        return ContasResource::collection($users);
    }

    public function register(ContasRequest $request){
        $input = $request->validated();

        $input['data_lancamento'] = now();

        $input['status'] = 1;

        $user = Contas::query()->create($input);

        return new ContasResource($user);
    }

    public function update(){

    }

    public function destroy(){

    }

}
