<?php

namespace App\Http\Controllers\Auth;

use App\Events\UsuarioRegistrado;
use App\Exceptions\UserHasBeenTakenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistroRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Str;

class RegistroController extends Controller
{
    public function __invoke(RegistroRequest $request)
    {
        $input = $request->validated();

        if(User::query()->whereEmail($input['email'])->exists()) {
            throw new UserHasBeenTakenException();
        }

        $input['password'] = bcrypt($input['password']);
        $input['token'] = Str::uuid();
        $user = User::query()->create($input);

        UsuarioRegistrado::dispatch($user);

        return new UserResource($user);

    }
}
