<x-app-layout>


    <x-slot name="header">
        <h2 class="text-3xl font-bold text-blue-600">
            {{ __('Solicitações Disponíveis') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 fade-in">

                <h3 class="text-2xl font-bold text-gray-800 mb-6">Demandas Disponíveis</h3>


                @if($demands->isEmpty())
                <div class="bg-blue-50 border border-blue-200 p-6 rounded-lg text-center text-gray-600">
                    Nenhuma solicitação de serviço encontrada.
                </div>
                @else
                <div class="space-y-6">
                    @foreach($demands as $demand)
                    <div x-data="{ open: false }">
                        <!-- Card clicável -->
                        <div class="demand-card border rounded-xl p-6 flex gap-6 hover-scale cursor-pointer" @click="open = true">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-xl font-bold text-gray-800">
                                        {{ $demand->title }}
                                    </h4>
                                    <span class="text-sm px-3 py-1 rounded-full 
                    {{ $demand->status == 'pendente' ? 'bg-yellow-100 text-yellow-700' : ($demand->status == 'concluido' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700') }}">
                                        {{ ucfirst($demand->status) }}
                                    </span>
                                </div>

                                <p class="text-gray-600 mb-4">
                                    {{ $demand->description }}
                                </p>

                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm text-gray-600">
                                    <p><strong>Cliente:</strong> {{ $demand->client->name ?? 'N/A' }}</p>
                                    <p><strong>Categoria de Serviço:</strong> {{ $demand->demand->category->name ?? 'N/A' }}</p>
                                    <p><strong>Orçamento Esperado:</strong> R$ {{ number_format($demand->expected_budget, 2, ',', '.') }}</p>
                                    <p><strong>Data Desejada:</strong> {{ optional($demand->desired_date)->format('d/m/Y') }}</p>
                                    <p><strong>Urgência:</strong> {{ ucfirst($demand->urgency) }}</p>
                                </div>
                            </div>

                            <div class="flex flex-col space-y-2" @click.stop>
                                <a href="{{ route('solicitacoes.edit', $demand->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm text-center">
                                    Detalhes
                                </a>

                                <form action="{{ route('demands.accept', $demand->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja aceitar esta solicitação?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-800 text-white px-4 py-2 rounded-lg text-sm">
                                        💷 Aceitar
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                            <div @click.away="open = false" class="bg-white p-6 rounded-xl shadow-xl w-full max-w-xl">
                                <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $demand->title }}</h2>

                                <p class="mb-2"><strong>Descrição:</strong> {{ $demand->description }}</p>
                                <p class="mb-2"><strong>Cliente:</strong> {{ $demand->client->name ?? 'N/A' }}</p>
                                <p class="mb-2"><strong>Categoria:</strong> {{ $demand->demand->category->name ?? 'N/A' }}</p>
                                <p class="mb-2"><strong>Orçamento Esperado:</strong> R$ {{ number_format($demand->expected_budget, 2, ',', '.') }}</p>
                                <p class="mb-2"><strong>Data Desejada:</strong> {{ optional($demand->desired_date)->format('d/m/Y') }}</p>
                                <p class="mb-2"><strong>Status:</strong> {{ ucfirst($demand->status) }}</p>
                                <p class="mb-2"><strong>Urgência:</strong> {{ ucfirst($demand->urgency) }}</p>

                                <div class="mt-4 text-right">
                                    <button @click="open = false"
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                                        Fechar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                @endif

            </div>
        </div>

    </div>
    <x-footer />
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .demand-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .demand-card:hover {
            border-left-color: #2563eb;
            background: #f8fafc;
        }
    </style>
</x-app-layout>