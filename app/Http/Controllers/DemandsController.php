<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        $status = $request->input('status');
        $professionalId = Auth::id();

        $query = ServiceRequest::with('service', 'client');

        // Filtro por status
        if ($status) {
            $query->where('status', $status);
        } else {
            $query->whereIn('status', ['open', 'in_negotiation', 'rejected']);
        }

        // Mostrar os que ainda não foram aceitos OU já aceitos por esse profissional
        $query->where(function ($q) use ($professionalId) {
            $q->whereNull('professional_id')
                ->orWhere('professional_id', $professionalId);
        });

        $demands = $query->get();

        return view('profissionais.list', compact('demands', 'status'));
    }
    public function accept($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        if (in_array($serviceRequest->status, ['open', 'in_negotiation', 'rejected'])) {
            $serviceRequest->status = 'accepted';
            $serviceRequest->professional_id = auth()->id();
            $serviceRequest->save();

            // Chama a procedure
            DB::statement("CALL create_service_order_after_accept(?,?)", [$serviceRequest->id, $serviceRequest->expected_budget]);

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
