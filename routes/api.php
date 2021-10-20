<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UIController;
use \App\Http\Controllers\UsuariosController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth', [AuthController::class, 'login']);
Route::get('/auth/renew', [AuthController::class, 'renew'])->middleware('auth:sanctum');
Route::get('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user/menu', [AuthController::class, 'userMenu'])->middleware('auth:sanctum');
Route::post('/user/list', [UsuariosController::class, 'list'])->middleware('auth:sanctum');
Route::post('/user/crear', [UsuariosController::class, 'crear'])->middleware('auth:sanctum');
Route::post('/user/borrar', [UsuariosController::class, 'borrar'])->middleware('auth:sanctum');

Route::get('/ui/areas', [UIController::class, 'areas'])->middleware('auth:sanctum');

