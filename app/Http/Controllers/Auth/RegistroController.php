<?php

namespace App\Http\Controllers\Auth;

use App\Events\UsuarioRegistrado;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistroRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class RegistroController extends Controller
{
    public function __invoke(RegistroRequest $request)
    {
        $input = $request->validated();

        $input['password'] = bcrypt($input['password']);
        $user = User::query()->create($input);

        UsuarioRegistrado::dispatch($user);

        return new UserResource($user);

    }
}
