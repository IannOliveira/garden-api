<?php

namespace App\Http\Controllers\Auth;

use App\Events\ForgotPasswordTokenRequested;
use App\Exceptions\UsuarioNaoEncontradoException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EsqueciSenhaRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EsqueciSenhaController extends Controller{
    public function __invoke(EsqueciSenhaRequest $request)
    {
         $input = $request->validated();

         $user = User::query()
             ->whereEmail($input['email'])
             ->first();

         if(!$user) {
             throw new UsuarioNaoEncontradoException();
         }

         $token = $user->resetPasswordTokens()->create([
             'token' => strtoupper(Str::random(6))
         ]);

         ForgotPasswordTokenRequested::dispatch($user, $token->token);
    }
}
