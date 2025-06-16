<x-admin-layout>
    <x-slot name="header">
        Relatório Total
    </x-slot>

    <div class="space-y-6">
        <!-- Cards de Estatísticas Principais -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total de Usuários -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total de Usuários</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ number_format($totalUsers) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total de Clientes -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total de Clientes</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ number_format($recentClients) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total de Profissionais -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.75 2.524z"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total de Profissionais</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ number_format($recentProfessionals) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Solicitações -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 2a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total de Solicitações</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ number_format($totalServiceRequests) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards de Valores -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Dinheiro Guardado -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Dinheiro Guardado</h3>
                </div>
                <div class="p-6">
                    <div class="text-3xl font-bold text-gray-900">
                        R$ {{ number_format($totalGuardedMoney, 2, ',', '.') }}
                    </div>
                </div>
            </div>

            <!-- Lucro Mensal -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Lucro Mensal</h3>
                </div>
                <div class="p-6">
                    <div class="text-3xl font-bold text-gray-900">
                        R$ {{ number_format($monthlyEarnings['current_month'], 2, ',', '.') }}
                    </div>
                    <div class="flex items-center mt-2">
                        <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L10 4.414 6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-green-600 text-sm ml-1">
                            +{{ number_format($monthlyEarnings['growth_percentage'], 1) }}% este mês
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Serviços por Mês -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-xl font-medium text-gray-900">Serviços por Mês</h3>
            </div>
            <div class="p-6">
                <div class="h-64 flex items-end justify-center space-x-4">
                    @foreach($servicesPerMonth as $month => $count)
                        <div class="flex flex-col items-center">
                            <div class="bg-blue-500 w-12 rounded-t" style="height: {{ ($count / max($servicesPerMonth->values()->toArray())) * 200 }}px"></div>
                            <span class="text-sm text-gray-600 mt-2">{{ $month }}</span>
                            <span class="text-xs text-gray-500">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Profissionais Cadastrados e Atividades Recentes -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Profissionais Cadastrados por Categoria -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-xl font-medium text-gray-900">Profissionais Cadastrados</h3>
                    <p class="text-sm text-gray-600">Últimos 30 dias</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($professionalsRegistered as $profession => $count)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-900">{{ $profession }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600 mr-2">{{ $count }}</span>
                                    <div class="w-20 bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ ($count / max($professionalsRegistered)) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Resumo de Atividades -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-xl font-medium text-gray-900">Resumo de Atividades</h3>
                    <p class="text-sm text-gray-600">Últimas ações do sistema</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-green-400 rounded-full mt-2"></div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Novos Clientes Registrados</p>
                                <p class="text-sm text-gray-600">{{ number_format($totalClients) }} clientes ativos</p>
                                <p class="text-xs text-gray-500">Atualizado há 2 minutos</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Profissionais Verificados</p>
                                <p class="text-sm text-gray-600">{{ number_format($totalProfessionals) }} profissionais ativos</p>
                                <p class="text-xs text-gray-500">Atualizado há 5 minutos</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-yellow-400 rounded-full mt-2"></div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Solicitações Pendentes</p>
                                <p class="text-sm text-gray-600">{{ number_format($totalServiceRequests) }} solicitações ativas</p>
                                <p class="text-xs text-gray-500">Atualizado há 1 minuto</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-purple-400 rounded-full mt-2"></div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Transações Processadas</p>
                                <p class="text-sm text-gray-600">R$ {{ number_format($totalGuardedMoney, 2, ',', '.') }} em custódia</p>
                                <p class="text-xs text-gray-500">Atualizado agora</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Crescimento de Usuários -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-xl font-medium text-gray-900">Crescimento de Usuários</h3>
                <p class="text-sm text-gray-600">Comparativo mensal de cadastros</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Clientes -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($totalClients) }}</div>
                        <div class="text-sm text-gray-600">Clientes Totais</div>
                        <div class="text-xs text-green-600 mt-1">+12% este mês</div>
                    </div>
                    
                    <!-- Profissionais -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($totalProfessionals) }}</div>
                        <div class="text-sm text-gray-600">Profissionais Totais</div>
                        <div class="text-xs text-purple-600 mt-1">+8% este mês</div>
                    </div>
                    
                    <!-- Conversão -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format(($totalServiceRequests / max($totalUsers, 1)) * 100, 1) }}%</div>
                        <div class="text-sm text-gray-600">Taxa de Conversão</div>
                        <div class="text-xs text-blue-600 mt-1">+2.3% este mês</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer com Informações Adicionais -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <h4 class="font-medium text-gray-900 mb-2">Tempo Médio de Resposta</h4>
                        <p class="text-2xl font-bold text-blue-600">2.4h</p>
                        <p class="text-sm text-gray-600">Para aceitar solicitações</p>
                    </div>
                    
                    <div class="text-center">
                        <h4 class="font-medium text-gray-900 mb-2">Satisfação do Cliente</h4>
                        <p class="text-2xl font-bold text-green-600">4.8/5</p>
                        <p class="text-sm text-gray-600">Avaliação média</p>
                    </div>
                    
                    <div class="text-center">
                        <h4 class="font-medium text-gray-900 mb-2">Última Atualização</h4>
                        <p class="text-2xl font-bold text-gray-600">{{ date('H:i') }}</p>
                        <p class="text-sm text-gray-600">{{ date('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>