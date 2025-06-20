<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-blue-600">
            {{ __('Minhas Solicitações') }}
        </h2>
    </x-slot>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Modal-specific styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-content {
            background-color: white;
            width: 100%;
            max-width: 32rem;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10000;
        }

        /* Prevent scrolling when modal is open */
        body.modal-open {
            overflow: hidden;
        }

        /* Your existing styles... */
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

        .service-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .service-card:hover {
            border-left-color: #2563eb;
            background: #f8fafc;
        }
    </style>

    <div class="py-10 bg-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 fade-in">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Solicitações de Serviço</h3>

                <a href="{{ route('solicitacoes.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow">
                    + Nova Solicitação
                </a>

                @if($services->isEmpty())
                <div class="bg-blue-50 border border-blue-200 p-6 rounded-lg text-center text-gray-600">
                    Nenhuma solicitação de serviço encontrada.
                </div>
                @else
                <div class="space-y-6">
                    @foreach($services as $service)
                    <div class="service-card border rounded-xl p-6 flex gap-6 hover-scale"
                        x-data="{ showRateModal: false }">
                        <!-- Service Card Content -->
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-xl font-bold text-gray-800">
                                    {{ $service->title }}
                                </h4>
                                <span class="text-sm px-3 py-1 rounded-full 
                                    {{ $service->status == 'pendente' ? 'bg-yellow-100 text-yellow-700' : 
                                       ($service->status == 'completed' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700') }}">
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
                            @if ($service->status != 'completed')
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
                            @endif

                            @if ($service->status === 'completed')
                            <!-- Rating Button -->
                            <button class="w-full bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
                                @click="showRateModal = true; document.body.classList.add('modal-open')">
                                ⭐ Avaliar Serviço
                            </button>

                            <!-- Modal Structure -->
                            <template x-teleport="body">
                                <div x-show="showRateModal"
                                    x-cloak
                                    x-transition
                                    @keydown.escape.window="showRateModal = false; document.body.classList.remove('modal-open')">

                                    <!-- Overlay -->
                                    <div class="modal-overlay"
                                        x-show="showRateModal"
                                        x-transition.opacity
                                        @click="showRateModal = false; document.body.classList.remove('modal-open')"></div>

                                    <!-- Modal Container -->
                                    <div class="modal-container">
                                        <div class="modal-content"
                                            x-show="showRateModal"
                                            x-transition
                                            @click.stop>

                                            <!-- Modal Header -->
                                            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                                                <h2 class="text-2xl font-bold text-gray-800">Avaliação do Serviço</h2>
                                                <button @click="showRateModal = false; document.body.classList.remove('modal-open')"
                                                    class="text-gray-500 hover:text-gray-700 p-2 rounded-lg transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="px-6 py-5 space-y-6 max-h-[80vh] overflow-y-auto">
                                                <!-- Service Info -->
                                                <div class="bg-gray-50 p-4 rounded-lg space-y-3 text-sm text-gray-800">
                                                    <p class="flex items-start">
                                                        <strong class="w-32 flex-shrink-0">Título:</strong>
                                                        <span class="flex-1">{{ $service->title }}</span>
                                                    </p>
                                                    <p class="flex items-start">
                                                        <strong class="w-32 flex-shrink-0">Descrição:</strong>
                                                        <span class="flex-1">{{ $service->description }}</span>
                                                    </p>
                                                    <p class="flex items-center">
                                                        <strong class="w-32 flex-shrink-0">Orçamento estimado:</strong>
                                                        <span>R$ {{ number_format($service->expected_budget, 2, ',', '.') }}</span>
                                                    </p>
                                                    <p class="flex items-center">
                                                        <strong class="w-32 flex-shrink-0">Data desejada:</strong>
                                                        <span>{{ optional($service->desired_date)->format('d/m/Y H:i') }}</span>
                                                    </p>
                                                    <p class="flex items-start">
                                                        <strong class="w-32 flex-shrink-0">Endereço:</strong>
                                                        <span class="flex-1">{{ $service->service_address }}</span>
                                                    </p>
                                                    <p class="flex items-center">
                                                        <strong class="w-32 flex-shrink-0">Urgência:</strong>
                                                        <span>
                                                            @if($service->urgency == 'low') Baixa
                                                            @elseif($service->urgency == 'medium') Média
                                                            @else Alta
                                                            @endif
                                                        </span>
                                                    </p>
                                                </div>

                                                <!-- Professional Info -->
                                                
                                                <div class="bg-gray-100 p-4 rounded-lg space-y-3 text-sm text-gray-800">
                                                    <h4 class="text-l font-bold text-gray-700">Dados do profissional</h2>
                                                    @if($service->serviceOrder?->professional)
                                                    <p class="flex items-center">
                                                        <strong class="w-32 flex-shrink-0">Nome:</strong>
                                                        <span>{{ $service->serviceOrder->professional->name }}</span>
                                                    </p>
                                                    <p class="flex items-center">
                                                        <strong class="w-32 flex-shrink-0">Email:</strong>
                                                        <span>{{ $service->serviceOrder->professional->email }}</span>
                                                    </p>
                                                    @if($service->serviceOrder->professional->phone)
                                                    <p class="flex items-center">
                                                        <strong class="w-32 flex-shrink-0">Telefone:</strong>
                                                        <span>{{ $service->serviceOrder->professional->phone }}</span>
                                                    </p>
                                                    @endif
                                                    @else
                                                    <p class="flex items-center">
                                                        <strong class="w-32 flex-shrink-0">Profissional:</strong>
                                                        <span>Nenhum profissional atribuído</span>
                                                    </p>
                                                    @endif
                                                </div>

                                                <!-- Rating Form -->
                                                <form action="{{ route('solicitacoes.rate', $service->id) }}" method="POST" class="space-y-4" x-data="{ rating: {{ optional(optional($service->orderService)->evaluation)->rate ?? 0 }} }">
                                                    @csrf
                                                    <input type="hidden" name="service_request_id" value="{{ $service->id }}">
                                                    <input type="hidden" name="rating" :value="rating">

                                                    <!-- Star Rating -->
                                                    <div class="space-y-2">
                                                        <label class="block text-gray-700 font-medium">Avaliação:</label>
                                                        <div class="flex space-x-1 text-yellow-500 text-2xl">
                                                            <template x-for="star in 5" :key="star">
                                                                <svg @click="rating = star"
                                                                    @mouseover="rating = star"
                                                                    @mouseleave="rating = rating"
                                                                    :class="{ 'fill-yellow-400': rating >= star, 'fill-gray-300': rating < star }"
                                                                    class="cursor-pointer w-8 h-8 transition hover:scale-110"
                                                                    fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.912c.969 0 1.371 1.24.588 1.81l-3.974 2.89a1 1 0 00-.364 1.118l1.519 4.674c.3.921-.755 1.688-1.538 1.118l-3.974-2.89a1 1 0 00-1.176 0l-3.974 2.89c-.783.57-1.838-.197-1.538-1.118l1.519-4.674a1 1 0 00-.364-1.118l-3.974-2.89c-.783-.57-.38-1.81.588-1.81h4.912a1 1 0 00.95-.69l1.519-4.674z" />
                                                                </svg>
                                                            </template>
                                                        </div>
                                                    </div>

                                                    <!-- Comment -->
                                                    <div class="space-y-2">
                                                        <label class="block text-gray-700 font-medium">Comentário:</label>
                                                        <textarea name="comment" rows="4"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                            placeholder="Descreva sua experiência com o profissional ou serviço..."></textarea>
                                                    </div>

                                                    <!-- Form Buttons -->
                                                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                                                        <button type="button"
                                                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition duration-200"
                                                            @click="showRateModal = false; document.body.classList.remove('modal-open')">
                                                            Cancelar
                                                        </button>
                                                        <button type="submit"
                                                            class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-200 shadow-md hover:shadow-lg">
                                                            Enviar Avaliação
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-footer />
    <script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>