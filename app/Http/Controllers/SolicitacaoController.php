<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SolicitacaoController extends Controller
{
    public function create()
    {
        return view('solicitacoes.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'date' => 'required|date',
        ]);

         $validated['client_id'] = Auth::id();
        // Salvar no banco
        ServiceRequest::create($validated);

        return redirect()->route('solicitacoes.create')->with('success', 'Solicitação enviada com sucesso!');
    }
}
