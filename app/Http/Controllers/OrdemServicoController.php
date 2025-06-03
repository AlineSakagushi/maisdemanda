<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\Solicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrdemServicoController extends Controller
{
    /**
     * Display a listing of service orders.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $ordens = OrdemServico::with(['solicitacao', 'solicitacao.servico', 'solicitacao.cliente'])
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return response()->json($ordens);
    }

    /**
     * Display the specified service order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $ordem = OrdemServico::with(['solicitacao', 'solicitacao.servico', 'solicitacao.cliente'])
                    ->findOrFail($id);
                    
        return response()->json($ordem);
    }

    /**
     * Store a newly created service order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'solicitacao_id' => 'required|exists:solicitacoes,id',
            'data_agendada' => 'required|date',
            'horario_agendado' => 'required|string',
            'observacoes' => 'nullable|string',
            'valor_final' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Verify if the request is accepted
        $solicitacao = Solicitacao::findOrFail($request->solicitacao_id);
        if ($solicitacao->status !== 'aceito') {
            return response()->json(['message' => 'A solicitação precisa estar aceita para criar uma ordem de serviço'], 400);
        }

        $ordem = OrdemServico::create([
            'solicitacao_id' => $request->solicitacao_id,
            'data_agendada' => $request->data_agendada,
            'horario_agendado' => $request->horario_agendado,
            'observacoes' => $request->observacoes,
            'valor_final' => $request->valor_final,
            'status' => 'pendente',
            'tecnico_id' => Auth::id() // Assuming the authenticated user is the technician
        ]);

        return response()->json([
            'message' => 'Ordem de serviço criada com sucesso',
            'ordem_servico' => $ordem->load(['solicitacao', 'solicitacao.servico'])
        ], 201);
    }

    /**
     * Update the specified service order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $ordem = OrdemServico::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'data_agendada' => 'sometimes|date',
            'horario_agendado' => 'sometimes|string',
            'observacoes' => 'nullable|string',
            'valor_final' => 'sometimes|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $ordem->update($request->all());

        return response()->json([
            'message' => 'Ordem de serviço atualizada com sucesso',
            'ordem_servico' => $ordem->load(['solicitacao', 'solicitacao.servico'])
        ]);
    }

    /**
     * Start the specified service order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function iniciar($id)
    {
        $ordem = OrdemServico::findOrFail($id);
        
        // Authorization check - only technician can start
        if (Auth::id() !== $ordem->tecnico_id) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $ordem->update([
            'status' => 'em_andamento',
            'data_inicio' => now()
        ]);

        return response()->json([
            'message' => 'Ordem de serviço iniciada com sucesso',
            'ordem_servico' => $ordem
        ]);
    }

    /**
     * Complete the specified service order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function concluir($id)
    {
        $ordem = OrdemServico::findOrFail($id);
        
        // Authorization check - only technician can complete
        if (Auth::id() !== $ordem->tecnico_id) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $ordem->update([
            'status' => 'concluido',
            'data_conclusao' => now()
        ]);

        return response()->json([
            'message' => 'Ordem de serviço concluída com sucesso',
            'ordem_servico' => $ordem
        ]);
    }

    /**
     * Cancel the specified service order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelar($id)
    {
        $ordem = OrdemServico::findOrFail($id);
        
        // Authorization check - only technician or admin can cancel
        if (Auth::id() !== $ordem->tecnico_id && !Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $ordem->update([
            'status' => 'cancelado',
            'data_cancelamento' => now()
        ]);

        return response()->json([
            'message' => 'Ordem de serviço cancelada com sucesso',
            'ordem_servico' => $ordem
        ]);
    }
}