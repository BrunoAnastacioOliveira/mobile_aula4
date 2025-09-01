<?php

use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Rotas para visualizar os registros
Route::get('/', function () {
    return response()->json(['Sucesso' => true]);
});
Route::get('/produto', [ProdutosController::class, 'index']);
Route::get('/produtos/{codigo}', [ProdutosController::class, 'show']);

// Rota para inserir os registros
Route::post('/produtos', [ProdutosController::class, 'store']);

// Rota para alterar os registros
Route::put('/produtos/{codigo}', [ProdutosController::class, 'update']);

// Rota para excluir o registro por id/codigo
Route::delete('/produtos/{id}', [ProdutosController::class, 'destroy']);
