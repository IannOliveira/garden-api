<?php

namespace App\Http\Controllers\Cliente;

use App\Exceptions\CpfDuplicadoException;
use App\Exceptions\RgDuplicadoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\ClienteRequest;
use App\Http\Resources\Cliente\ClienteResource;
use App\Models\Cliente;

class ClienteController extends Controller
{

   // public function __construct(){
     //   $this->middleware('auth:sanctum');
    //}

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

    public function index(){

        $users = Cliente::all();

        return ClienteResource::collection($users);

    }

    public function register(ClienteRequest $request){
        $input = $request->validated();

        $existeCPF = Cliente::where('cpf', $input['cpf'])->first();

        if($existeCPF) {
            throw new CpfDuplicadoException();
        }

        $existeRG = Cliente::where('rg', $input['rg'])->first();

        if($existeRG) {
            throw new RgDuplicadoException();
        }

        $user = Cliente::query()->create($input);

        return new ClienteResource($user);
    }

    public function update(ClienteRequest $request, $id){

        $user = Cliente::findOrFail($id);

        $input = $request->validated();

        if ($input['cpf'] !== $user->cpf) {
            $existeCPF = Cliente::where('cpf', $input['cpf'])->first();

            if ($existeCPF) {
                throw new CpfDuplicadoException();
            }
        }

        if ($input['rg'] !== $user->rg) {
            $existeRG = Cliente::where('rg', $input['rg'])->first();

            if ($existeRG) {
                throw new RgDuplicadoException();
            }
        }

        $user->fill($input);
        $user->save();

        return new ClienteResource($user->fresh());
    }

    public function destroy($id){

        $user = Cliente::where('id', $id);

        $user->delete();
    }

}
