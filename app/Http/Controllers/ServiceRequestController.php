<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;



class ServiceRequestController extends Controller
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

    public function index()
    {
        $services = ServiceRequest::with('service', 'client')->get();

        return view('dashboard', compact('services'));
    }

        public function destroy($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        $serviceRequest->delete();

        return redirect()->route('service-requests.index')
            ->with('success', 'Solicitação de serviço deletada com sucesso.');
    }

        // Mostrar formulário de edição
    public function edit($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $services = Service::all(); // Buscar todos os serviços para popular o select

        return view('solicitacoes.edit', compact('serviceRequest', 'services'));
    }


    // Atualizar o registro
    public function update(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'expected_budget' => 'required|numeric|min:0',
            'desired_date' => 'required|date',
            'status' => 'required|string', // ajuste conforme seus status
            'urgency' => 'nullable|string|max:50',
            // outros campos que desejar validar...
        ]);

        $serviceRequest->update($validatedData);

        return redirect()->route('dashboard')
            ->with('success', 'Solicitação atualizada com sucesso!');
    }
}
