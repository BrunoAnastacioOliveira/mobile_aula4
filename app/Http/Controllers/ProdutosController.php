<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Iluminate\Http\Response;
use Iluminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = Produtos::all();

        $contador = $registros->count();

        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Produtos encontrados com sucesso!',
                'data' => $registros,
                'total' => $contador
            ] , 200);
            } else { 
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum produto encontrada.',
                ], 404);
            }
        }

                
          
      
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        $validator = Validator::make($request->all (),[

        'nome' => 'required',
        'marca'=> 'required',
         'preco' => 'required',

        ]);
    


    if ($Validator->fails()) {
    return response ()->json([
'sucess'=> false,
'message' => 'Registros inválidos',
'errors' => $Validator->errors()
    ], 400);
}

$registros = Produtos::create($request->all());

if ($registros) {
    return response()->json([
        'sucess' => true,
        'message' => 'Produtos cadastrados com sucesso!',
        'data' => $registros
    ], 201);
    return response()->json([
        'sucess' => false,
        'message' => 'Erro ao cadastrar um produto'
    ], 500);

        }
    }

    public function show($id)
{

    $registros = Produtos::find($id);


    if ($registros) {
        return response()->json([
            'sucess' => true,
            'message' => 'Produto nao localizado.',
        ], 404);
    }
} 

    /**
     * Display the specified resource.
     */
    public function update(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'nome' => 'required',
        'marca'=> 'required',
        'preco' => 'required',
    
    ]);

if ($validator->fails()) {
    return response()->json([
        'success' => false,
        'message' => 'Registros inválidos',
        'errors' => $validator->errors()
    ], 400);
}

$registrosBanco = Produtos::find($id);

if (!$registrosBanco) {
    return response()->json([
        'success' => false,
        'message' => 'Produto não encontrado'
    ], 404);
}

$registrosBanco->nome = $request->nome;
$registrosBanco->marca = $request->marca;
$registrosBanco->preco = $request->preco;

if ($registrosBanco->save()) {
    return response()->json([
        'success' => true,
        'message' => 'Produto atualizado com sucesso!',
        'data' => $registrosBanco
    ], 200);
} else {
    return response()->json([
        'success' => false,
        'message' => 'Erro ao atualizar o produto'
    ], 500);
}
}

public function destroy($id)
{
    $registros = Produtos::find($id);

    if (!$registros) {
        return response()->json([
            'success' => false,
            'message' => 'Produto não encontrado'
        ], 404);
    }

    if ($registros->delete()) {
        return response()->json([
            'success' => true,
            'message' => 'Produto deletado com sucesso'
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'Erro ao deletar um produto'
    ], 500);
}
}