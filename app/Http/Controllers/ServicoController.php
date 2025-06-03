<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ServicoController extends Controller
{
    /**
     * Display a listing of services.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $servicos = Servico::with(['categoria', 'prestador'])->get();
        return response()->json($servicos);
    }

    /**
     * Display the specified service.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $servico = Servico::with(['categoria', 'prestador'])->findOrFail($id);
        return response()->json($servico);
    }

    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'titulo' => 'required|string|max:255',
        'descricao' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id',
        'prestador_id' => 'required|exists:users,id',
        'valor_base' => 'required|numeric|min:0',
        'localizacao' => 'required|string',
        'disponibilidade' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $servico = Servico::create($request->all());

    return response()->json([
        'message' => 'Serviço criado com sucesso',
        'servico' => $servico->load(['categoria', 'prestador'])
    ], 201);
}

public function update(Request $request, $id)
{
    $servico = Servico::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'titulo' => 'sometimes|string|max:255',
        'descricao' => 'sometimes|string',
        'categoria_id' => 'sometimes|exists:categorias,id',
        'valor_base' => 'sometimes|numeric|min:0',
        'localizacao' => 'sometimes|string',
        'disponibilidade' => 'sometimes|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $servico->update($request->all());

    return response()->json([
        'message' => 'Serviço atualizado com sucesso',
        'servico' => $servico->load(['categoria', 'prestador'])
    ]);
}

    /**
     * Remove the specified service from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $servico = Servico::findOrFail($id);
        $servico->delete();
        return response()->json(null, 204);
    }

    /**
     * Search services by category.
     *
     * @param  int  $categoria_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscarPorCategoria($categoria_id)
    {
        $servicos = Servico::with(['categoria', 'prestador'])
                        ->where('categoria_id', $categoria_id)
                        ->get();

        return response()->json($servicos);
    }

    /**
     * Search services by location.
     *
     * @param  string  $localizacao
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscarPorLocalizacao($localizacao)
    {
        $servicos = Servico::with(['categoria', 'prestador'])
                        ->where('localizacao', 'like', "%$localizacao%")
                        ->get();

        return response()->json($servicos);
    }
}