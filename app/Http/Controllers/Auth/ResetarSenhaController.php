<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\RedefinirSenhaTokenInvalidoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetarSenhaRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserPasswordResetToken;

class ResetarSenhaController extends Controller
{
    public function __invoke(ResetarSenhaRequest $request)
    {
        $input = $request->validated();

        $token = UserPasswordResetToken::query()
            ->with('user')
            ->whereToken($input['token'])
            ->whereDate('created_at', '>=', now()->subHours(24)->toDateString())
            ->first();

        if(!$token) {
            throw new RedefinirSenhaTokenInvalidoException();
        }

        $user = $token->user;
        $user->password = bcrypt($input['password']);
        $user->save();

        $user->resetPasswordTokens()->delete();

        return new UserResource($user);

    }


}
