<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:sanctum')->get('/me', [\App\Http\Controllers\Me\MeController::class, 'show']);

Route::post('login', \App\Http\Controllers\Auth\LoginController::class);
Route::post('logout', \App\Http\Controllers\Auth\LogoutController::class);
Route::post('registro', \App\Http\Controllers\Auth\RegistroController::class);
Route::post('verificar-email', \App\Http\Controllers\Auth\VerificarEmailController::class);
