<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">Solicitações de Serviço</h3>

                @if($services->isEmpty())
                    <p class="text-gray-500">Nenhuma solicitação de serviço encontrada.</p>
                @else
                    <div class="space-y-4">
                        @foreach($services as $service)
                            <div class="border border-gray-200 rounded p-4 shadow-sm flex justify-between items-start">
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-800">
                                        {{ $service->title }}
                                    </h4>
                                    <p class="text-gray-600">{{ $service->description }}</p>

                                    <div class="mt-2 text-sm text-gray-500">
                                        <p><strong>Cliente:</strong> {{ $service->client->name ?? 'N/A' }}</p>
                                        <p><strong>Serviço:</strong> {{ $service->service->name ?? 'N/A' }}</p>
                                        <p><strong>Orçamento Esperado:</strong> R$ {{ number_format($service->expected_budget, 2, ',', '.') }}</p>
                                        <p><strong>Data Desejada:</strong> {{ optional($service->desired_date)->format('d/m/Y') }}</p>
                                        <p><strong>Status:</strong> {{ ucfirst($service->status) }}</p>
                                        <p><strong>Urgência:</strong> {{ ucfirst($service->urgency) }}</p>
                                    </div>
                                </div>

                                <div class="flex space-x-2">
                                    <!-- Botão Editar -->
                                    <a href="{{ route('solicitacoes.edit', $service->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        Editar
                                    </a>

                                    <!-- Botão Deletar -->
                                    <form action="{{ route('solicitacoes.destroy', $service->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Tem certeza que deseja deletar esta solicitação?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            Deletar
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
</x-app-layout>
