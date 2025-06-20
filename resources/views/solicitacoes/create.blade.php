<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-blue-600">
            Solicitação de Serviço
        </h2>
    </x-slot>

    <main class="flex-1 px-6 py-10 bg-blue-100">
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl mx-auto fade-in">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                ✍️ Crie sua Solicitação
            </h2>

            <form action="{{ route('solicitacoes.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Título --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Título</label>
                    <input 
                        type="text" 
                        name="title" 
                        placeholder="Ex: Conserto de encanamento" 
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        required
                    />
                </div>

                {{-- Descrição --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Descrição</label>
                    <textarea 
                        name="description" 
                        placeholder="Descreva o serviço que você precisa..." 
                        rows="4" 
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required
                    ></textarea>
                </div>

                {{-- Categoria e Data --}}
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block font-medium mb-2 text-gray-700">Categoria</label>
                        <select 
                            name="service_category_id" 
                            class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required
                        >
                            <option disabled selected>Selecione...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block font-medium mb-2 text-gray-700">Data Desejada</label>
                        <input 
                            type="date" 
                            name="desired_date" 
                            class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>
                </div>

                {{-- Valor Esperado --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Valor Esperado (R$)</label>
                    <input 
                        type="number" 
                        name="expected_budget" 
                        placeholder="Ex: 150.00" 
                        step="0.01" 
                        min="0" 
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required
                    />
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Status</label>
                    <select 
                        name="status" 
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                        <option value="open" selected>Aberto</option>
                        <option value="in_negotiation">Em Negociação</option>
                        <option value="closed">Fechado</option>
                        <option value="cancelled">Cancelado</option>
                    </select>
                </div>

                {{-- Urgência --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Urgência</label>
                    <select 
                        name="urgency" 
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                        <option disabled selected>Selecione...</option>
                        <option value="High">Alta</option>
                        <option value="Medium" selected>Média</option>
                        <option value="Low">Baixa</option>
                    </select>
                </div>

                {{-- Botões --}}
                <div class="flex justify-center gap-6 mt-8">
                    <a 
                        href="{{ route('dashboard') }}" 
                        class="border border-red-500 text-red-500 px-6 py-2 rounded-lg hover:bg-red-100 transition hover-scale"
                    >
                        Cancelar
                    </a>
                    <button 
                        type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition hover-scale"
                    >
                        Enviar Solicitação
                    </button>
                </div>
            </form>
        </div>
    </main>
    <x-footer />
</x-app-layout>