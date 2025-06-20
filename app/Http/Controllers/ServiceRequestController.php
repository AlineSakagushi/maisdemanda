<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\ServiceCategory;


class ServiceRequestController extends Controller
{
    public function create()
    {
        $services = Service::all();
        $categories = ServiceCategory::all();
        return view('solicitacoes.create', compact('services', 'categories'));
    }

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

        $service = Service::create([
            'service_category_id' => $validated['service_category_id'],
            'price' => $validated['expected_budget'],
            'status' => 'active',
        ]);

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

        return redirect()->route('dashboard')->with('success', 'Solicitação criada com sucesso!');
    }

    public function index()
    {
        $services = ServiceRequest::with([
            'service', 
            'client',
            'serviceOrder.professional' // Add this relationship chain
        ])
        ->where('client_id', auth()->id())
        ->get();

        return view('dashboard', compact('services'));
    }

    public function destroy($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->delete();

        return redirect()->route('dashboard')->with('success', 'Solicitação de serviço deletada com sucesso.');
    }

    public function edit($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $categories = ServiceCategory::all();

        return view('solicitacoes.edit', compact('serviceRequest', 'categories'));
    }

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

        $serviceRequest->service->update([
            'service_category_id' => $validated['service_category_id'],
            'price' => $validated['expected_budget'],
        ]);

        $serviceRequest->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'expected_budget' => $validated['expected_budget'],
            'desired_date' => $validated['desired_date'],
            'urgency' => $validated['urgency'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Solicitação atualizada com sucesso!');
    }

    public function rate(Request $request, $id)
    {

        $validated = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        try {
            $serviceRequest = ServiceRequest::with('serviceOrder')->findOrFail($id);

            if (!$serviceRequest->serviceOrder) {
                return back()->with('error', 'Ordem de serviço não encontrada.');
            }

            // Get related IDs
            $serviceOrder = $serviceRequest->serviceOrder;

            // Create or update evaluation with all required fields
            $evaluation = Evaluation::updateOrCreate(
                ['service_order_id' => $serviceOrder->id],
                [
                    'service_order_id' => $serviceOrder->id,
                    'client_id' => $serviceRequest->client_id,
                    'professional_id' => $serviceOrder->professional_id,
                    'service_id' => $serviceRequest->service_id,
                    'rating' => $validated['rating'],
                    'comment' => $validated['comment'],
                    'evaluation_date' => now()
                ]
            );

                    // 🔁 Chama a procedure para atualizar a média do profissional
        DB::statement('CALL UpdateProfessionalRatingAverage(?)', [
            $serviceOrder->professional_id,
        ]);


            return redirect()->route('dashboard')
                ->with('success', 'Avaliação atualizada com sucesso!');
        } catch (\Exception $e) {
            logger()->error('Evaluation Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Ocorreu um erro ao atualizar a avaliação: ' . $e->getMessage());
        }
    }
}
