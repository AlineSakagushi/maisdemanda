<x-app-layout>


    <div class="py-10 bg-gradient-to-br from-blue-100 via-sky-100 to-cyan-100 min-h-screen relative overflow-hidden">
        <!-- Elementos decorativos de fundo -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Círculos flutuantes -->
            <div class="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-1/3 right-20 w-96 h-96 bg-blue-200/15 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 left-1/4 w-80 h-80 bg-cyan-200/15 rounded-full blur-3xl animate-pulse" style="animation-delay: 4s;"></div>

            <!-- Pattern de pontos -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25px 25px, rgba(255,255,255,0.3) 2px, transparent 0); background-size: 50px 50px;"></div>
            </div>

            <!-- Formas geométricas -->
            <div class="absolute top-1/4 right-10 w-32 h-32 border-2 border-white/25 rotate-45 animate-spin" style="animation-duration: 20s;"></div>
            <div class="absolute bottom-1/3 left-10 w-24 h-24 border-2 border-blue-200/30 rotate-12 animate-bounce" style="animation-duration: 3s;"></div>
        </div>

        <!-- Conteúdo -->
        <div class="relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <!-- Header Section -->
                <div class="bg-gray-100 backdrop-blur-lg shadow-xl rounded-2xl p-6 mb-8 border border-white/20">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Demandas Disponíveis</h3>
                            <p class="text-black">Encontre oportunidades de trabalho perfeitas para você</p>
                        </div>

                        <!-- Filtros -->
                        <form method="GET" action="{{ route('demands.list') }}" class="flex flex-wrap gap-2">
                            {{-- Filtro por Categoria (opcional - não funcional aqui) --}}
                            <select class="px-4 py-2 rounded-lg border border-gray-200 bg-white/90 backdrop-blur text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option>Todas Categorias</option>
                            </select>

                            {{-- Filtro por Urgência (exemplo - não funcional aqui) --}}
                            <select class="px-4 py-2 rounded-lg border border-gray-200 bg-white/90 backdrop-blur text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option>Urgência</option>
                                <option>Alta</option>
                                <option>Média</option>
                                <option>Baixa</option>
                            </select>

                            {{-- Filtro por Status --}}
                            <select name="status" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-gray-200 bg-white/90 backdrop-blur text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Todos os Status</option>
                                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Aberto</option>
                                <option value="in_negotiation" {{ request('status') == 'in_negotiation' ? 'selected' : '' }}>Em Negociação</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejeitado</option>
                                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Aceito</option>
                            </select>
                        </form>
                    </div>
                </div>

                @if($demands->isEmpty())
                <!-- Estado Vazio -->
                <div class="bg-white/80 backdrop-blur-lg border border-gray-200 rounded-2xl p-12 text-center shadow-lg">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Nenhuma demanda disponível</h3>
                    <p class="text-gray-600 mb-6">Não há solicitações de serviço no momento. Volte em breve!</p>
                    <button class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Atualizar Página
                    </button>
                </div>
                @else
                <!-- Grid de Demandas -->
                <div class="grid gap-6 lg:gap-8">
                    @foreach($demands as $demand)
                    <div x-data="{ 
                    open: false,
                    showConfirmModal: false
                    }" class="group">

                        <!-- Card Principal -->
                        <div class="demand-card bg-white/80 backdrop-blur-lg border border-gray-200 rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 cursor-pointer transform hover:-translate-y-2"
                            @click="open = true">

                            <!-- Header do Card -->
                            <div class="flex flex-col lg:flex-row lg:items-start gap-6">

                                <!-- Conteúdo Principal -->
                                <div class="flex-1 space-y-4">

                                    <!-- Título e Status -->
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                        <h4 class="text-xl lg:text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                            {{ $demand->title }}
                                        </h4>
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                {{ $demand->status == 'pendente' ? 'bg-amber-100 text-amber-800 border border-amber-200' : 
                                                   ($demand->status == 'concluido' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 
                                                   'bg-gray-100 text-gray-800 border border-gray-200') }}">
                                                @if($demand->status == 'pendente')
                                                <div class="w-2 h-2 bg-amber-400 rounded-full mr-2 animate-pulse"></div>
                                                @elseif($demand->status == 'concluido')
                                                <div class="w-2 h-2 bg-emerald-400 rounded-full mr-2"></div>
                                                @endif
                                                {{ ucfirst($demand->status) }}
                                            </span>

                                            <!-- Urgência Badge -->
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                {{ $demand->urgency == 'alta' ? 'bg-red-100 text-red-800' : 
                                                   ($demand->urgency == 'media' ? 'bg-yellow-100 text-yellow-800' : 
                                                   'bg-green-100 text-green-800') }}">
                                                {{ $demand->urgency == 'alta' ? '🔥' : ($demand->urgency == 'media' ? '⚡' : '🕐') }}
                                                {{ ucfirst($demand->urgency) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Descrição -->
                                    <p class="text-gray-600 leading-relaxed line-clamp-2">
                                        {{ $demand->description }}
                                    </p>

                                    <!-- Informações em Grid -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">Cliente</p>
                                                <p class="text-gray-600">{{ $demand->client->name ?? 'N/A' }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">Categoria</p>
                                                <p class="text-gray-600">{{ $demand->demand->category->name ?? 'N/A' }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">Orçamento</p>
                                                <p class="text-green-600 font-semibold">R$ {{ number_format($demand->expected_budget, 2, ',', '.') }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10m6-10v10m6-7H2" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">Data Desejada</p>
                                                <p class="text-gray-600">{{ optional($demand->desired_date)->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botões de Ação -->
                                <div class="flex lg:flex-col gap-3 lg:min-w-[140px]" @click.stop>

                                    @if ($demand->status !== 'accepted' && $demand->status !== 'completed')
                                    <!-- Botão de Aceitar -->
                                    <form action="{{ route('demands.accept', $demand->id) }}" method="POST" class="flex-1 lg:flex-none"
                                        onsubmit="return confirm('Tem certeza que deseja aceitar esta solicitação?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                            ✨ Aceitar
                                        </button>
                                    </form>
                                    @elseif ($demand->status === 'accepted')
                                    <!-- Botão que abre o modal -->
                                    <button @click="showConfirmModal = true"
                                        class="w-full bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        ✅ Concluir Serviço
                                    </button>

                                    @endif


                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">

                            <div @click.away="open = false"
                                class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

                                <!-- Header do Modal -->
                                <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 rounded-t-2xl">
                                    <div class="flex items-center justify-between">
                                        <h2 class="text-2xl font-bold text-gray-800">{{ $demand->title }}</h2>
                                        <button @click="open = false"
                                            class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Conteúdo do Modal -->
                                <div class="p-6 space-y-6">
                                    <div class="bg-gray-50 p-4 rounded-xl">
                                        <h3 class="font-semibold text-gray-800 mb-2">Descrição</h3>
                                        <p class="text-gray-600 leading-relaxed">{{ $demand->description }}</p>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="bg-blue-50 p-4 rounded-xl">
                                            <h4 class="font-semibold text-gray-800 mb-2">Informações do Cliente</h4>
                                            <p class="text-gray-600"><strong>Nome:</strong> {{ $demand->client->name ?? 'N/A' }}</p>
                                        </div>

                                        <div class="bg-purple-50 p-4 rounded-xl">
                                            <h4 class="font-semibold text-gray-800 mb-2">Categoria</h4>
                                            <p class="text-gray-600">{{ $demand->demand->category->name ?? 'N/A' }}</p>
                                        </div>

                                        <div class="bg-green-50 p-4 rounded-xl">
                                            <h4 class="font-semibold text-gray-800 mb-2">Orçamento</h4>
                                            <p class="text-green-600 font-semibold text-lg">R$ {{ number_format($demand->expected_budget, 2, ',', '.') }}</p>
                                        </div>

                                        <div class="bg-orange-50 p-4 rounded-xl">
                                            <h4 class="font-semibold text-gray-800 mb-2">Data Desejada</h4>
                                            <p class="text-gray-600">{{ optional($demand->desired_date)->format('d/m/Y') }}</p>
                                        </div>

                                        <div class="bg-yellow-50 p-4 rounded-xl">
                                            <h4 class="font-semibold text-gray-800 mb-2">Status</h4>
                                            <p class="text-gray-600">{{ ucfirst($demand->status) }}</p>
                                        </div>

                                        <div class="bg-red-50 p-4 rounded-xl">
                                            <h4 class="font-semibold text-gray-800 mb-2">Urgência</h4>
                                            <p class="text-gray-600">{{ ucfirst($demand->urgency) }}</p>
                                        </div>
                                    </div>

                                    <!-- Botões do Modal -->
                                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                                        <button @click="open = false"
                                            class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-medium transition-colors">
                                            Fechar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal de confirmação -->
                        <div x-show="showConfirmModal"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90"
                            class="fixed inset-0 flex items-center justify-center bg-black/60 z-50"
                            style="display: none;">

                            <div @click.away="showConfirmModal = false"
                                class="bg-white rounded-xl p-6 shadow-lg w-full max-w-lg space-y-4 text-gray-800">

                                <h2 class="text-xl font-semibold text-center text-blue-600">Confirmar Conclusão do Serviço</h2>

                                <div class="space-y-2 text-sm">
                                    <p><strong>Título:</strong> {{ $demand->title }}</p>
                                    <p><strong>Descrição:</strong> {{ $demand->description }}</p>
                                    <p><strong>Data Desejada:</strong> {{ optional($demand->desired_date)->format('d/m/Y H:i') }}</p>
                                    <p><strong>Endereço:</strong> {{ $demand->service_address }}</p>
                                    <p><strong>Cliente:</strong> {{ $demand->client->name ?? 'N/A' }}</p>
                                </div>

                                <div class="text-2xl font-bold text-green-600 text-center border-t pt-4">
                                    💰 Valor do Serviço: R$ {{ number_format($demand->expected_budget, 2, ',', '.') }}
                                </div>
                                <div class="text-m font-bold text-gray-400 text-center border-t pt-4">
                                    💵 Confirme se o serviço foi pago com sucesso!
                                </div>
                                <div class="flex justify-end gap-3 pt-4">
                                    <button @click="showConfirmModal = false"
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md">
                                        Cancelar
                                    </button>

                                    <form action="{{ route('demands.complete', $demand->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-md shadow">
                                            💷 Confirmar Pagamento
                                        </button>
                                    </form>
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
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Animações para os elementos de fundo */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .demand-card {
            animation: fadeIn 0.6s ease-out;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            border: 1px solid rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(255, 255, 255, 0.1);
        }

        .demand-card:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.95) 100%);
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 20px 60px rgba(255, 255, 255, 0.15);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Scrollbar personalizada */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #7c3aed);
        }

        /* Animações para os cards */
        .group:nth-child(odd) .demand-card {
            animation-delay: 0.1s;
        }

        .group:nth-child(even) .demand-card {
            animation-delay: 0.2s;
        }
    </style>
</x-app-layout>