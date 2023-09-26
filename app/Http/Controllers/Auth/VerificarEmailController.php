<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\EmailVerificadoException;
use App\Exceptions\TokenInvalidoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerificarEmailRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class VerificarEmailController extends Controller
{
    public function __invoke(VerificarEmailRequest $request) {

        $input = $request->validated();

        $user = User::query()
            ->whereToken($input['token'])
            ->first();

        if(!$user) {
            throw new TokenInvalidoException();
        }

        if($user->email_verified_at) {
            throw new EmailVerificadoException();
        }

        $user->email_verified_at = now();
        $user->save();

        return UserResource($user);

    }
}
