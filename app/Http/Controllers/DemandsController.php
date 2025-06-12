<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\ServiceCategory;

class DemandsController extends Controller
{
    // Mostrar formulário de criação
    public function create()
    {
        $services = Service::all();
        $categories = ServiceCategory::all();
        return view('solicitacoes.create', compact('services', 'categories'));
    }

    // Salvar nova solicitação
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_category_id' => 'required|integer',
            'expected_budget' => 'required|numeric|min:0',
            'desired_date' => 'required|date',
            'status' => 'required|string|max:50',
            'urgency' => 'nullable|string|max:50',
        ]);

        // Criar um serviço básico vinculado à solicitação
        $service = Service::create([
            'service_category_id' => $validated['service_category_id'],
            'price' => $validated['expected_budget'],
            'status' => 'active',
        ]);

        // Criar a solicitação de serviço
        ServiceRequest::create([
            'client_id' => Auth::id(),
            'service_id' => $service->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'expected_budget' => $validated['expected_budget'],
            'desired_date' => $validated['desired_date'],
            'urgency' => $validated['urgency'] ?? null,
            'status' => $validated['status'],
            'request_date' => now(),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Solicitação criada com sucesso!');
    }

    // Listar solicitações
    public function index()
    {
        $demands = ServiceRequest::with('service', 'client')
                    ->whereIn('status', ['open', 'in_negotiation', 'rejected'])
                    ->get();

        return view('profissionais.list', compact('demands'));
    }


    public function accept($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        // Verifica se o status atual permite aceitar
        if (in_array($serviceRequest->status, ['open', 'in_negotiation', 'rejected'])) {
            $serviceRequest->status = 'accepted'; 
            $serviceRequest->save();

            return redirect()->back()->with('success', 'Solicitação aceita com sucesso!');
        }

        return redirect()->back()->with('error', 'Não é possível aceitar essa solicitação.');
    }


        public function destroy($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        $serviceRequest->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Solicitação de serviço deletada com sucesso.');
    }

        // Mostrar formulário de edição
    public function edit($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $categories = ServiceCategory::all();

        return view('solicitacoes.edit', compact('serviceRequest', 'categories'));
    }

    // Atualizar uma solicitação
    public function update(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_category_id' => 'required|integer',
            'expected_budget' => 'required|numeric|min:0',
            'desired_date' => 'required|date',
            'status' => 'required|string|max:50',
            'urgency' => 'nullable|string|max:50',
        ]);

        // Atualizar o serviço vinculado, se necessário
        $serviceRequest->service->update([
            'service_category_id' => $validated['service_category_id'],
            'price' => $validated['expected_budget'],
        ]);

        // Atualizar a solicitação
        $serviceRequest->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'expected_budget' => $validated['expected_budget'],
            'desired_date' => $validated['desired_date'],
            'urgency' => $validated['urgency'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Solicitação atualizada com sucesso!');
    }
}
