<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-blue-600">
            {{ __('Minhas Solicitações') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 fade-in">

                <h3 class="text-2xl font-bold text-gray-800 mb-6">Solicitações de Serviço</h3>
                
                <a href="{{ route('solicitacoes.create') }}" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 
                        text-white text-sm font-medium rounded-md shadow">
                + Nova Solicitação
                </a>

                @if($services->isEmpty())
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-lg text-center text-gray-600">
                        Nenhuma solicitação de serviço encontrada.
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($services as $service)
                            <div class="service-card border rounded-xl p-6 flex gap-6 hover-scale">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-xl font-bold text-gray-800">
                                            {{ $service->title }}
                                        </h4>
                                        <span class="text-sm px-3 py-1 rounded-full 
                                                     {{ $service->status == 'pendente' ? 'bg-yellow-100 text-yellow-700' : ($service->status == 'concluido' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700') }}">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>

                                    <p class="text-gray-600 mb-4">
                                        {{ $service->description }}
                                    </p>

                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm text-gray-600">
                                        <p><strong>Cliente:</strong> {{ $service->client->name ?? 'N/A' }}</p>
                                        <p><strong>Categoria de Serviço:</strong> {{ $service->service->category->name ?? 'N/A' }}</p>
                                        <p><strong>Orçamento Esperado:</strong> R$ {{ number_format($service->expected_budget, 2, ',', '.') }}</p>
                                        <p><strong>Data Desejada:</strong> {{ optional($service->desired_date)->format('d/m/Y') }}</p>
                                        <p><strong>Urgência:</strong> {{ ucfirst($service->urgency) }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col space-y-2">
                                    <a href="{{ route('solicitacoes.edit', $service->id) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm text-center">
                                        ✏️ Editar
                                    </a>

                                    <form action="{{ route('solicitacoes.destroy', $service->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Tem certeza que deseja deletar esta solicitação?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                                            🗑️ Deletar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
        .service-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .service-card:hover {
            border-left-color: #2563eb;
            background: #f8fafc;
        }
    </style>
</x-app-layout>
