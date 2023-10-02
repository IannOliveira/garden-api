<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Me\MeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\VerificarEmailController;
use App\Http\Controllers\Auth\EsqueciSenhaController;
use App\Http\Controllers\Auth\ResetarSenhaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/me', [MeController::class, 'show']);

Route::post('login', LoginController::class);
Route::post('logout', LogoutController::class);
Route::post('registro', RegistroController::class);
Route::post('verificar-email', VerificarEmailController::class);
Route::post('esqueci-senha', EsqueciSenhaController::class);
Route::post('resetar-senha', ResetarSenhaController::class);


Route::prefix('cliente')->group(function () {
    Route::get('', [\App\Http\Controllers\Cliente\ClienteController::class, 'index']);
    Route::post('', [\App\Http\Controllers\Cliente\ClienteController::class, 'register']);
    Route::put('{id}', [\App\Http\Controllers\Cliente\ClienteController::class, 'update']);
    Route::delete('{id}', [\App\Http\Controllers\Cliente\ClienteController::class, 'destroy']);
});
