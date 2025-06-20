<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-blue-600">
            Editar Solicitação de Serviço
        </h2>
    </x-slot>

    <main class="flex-1 px-6 py-10 bg-blue-100">
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl mx-auto fade-in">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                📝 Atualize sua Solicitação
            </h2>

            @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('solicitacoes.update', $serviceRequest->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Título --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Título</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $serviceRequest->title) }}"
                        placeholder="Ex: Instalação elétrica"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                {{-- Descrição --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Descrição</label>
                    <textarea
                        name="description"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>{{ old('description', $serviceRequest->description) }}</textarea>
                </div>

                {{-- Categoria e Data --}}
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block font-medium mb-2 text-gray-700">Categoria</label>
                        <select
                            name="service_category_id"
                            class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option disabled>Selecione...</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('service_category_id', $serviceRequest->service_category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block font-medium mb-2 text-gray-700">Data Desejada</label>
                        <input
                            type="date"
                            name="desired_date"
                            value="{{ old('desired_date', $serviceRequest->desired_date?->format('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required />
                    </div>
                </div>

                {{-- Orçamento --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Orçamento Esperado (R$)</label>
                    <input
                        type="number"
                        name="expected_budget"
                        value="{{ old('expected_budget', $serviceRequest->expected_budget) }}"
                        step="0.01"
                        min="0"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-medium mb-2 text-gray-700">Status</label>
                    <select
                        name="status"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        @php
                        $statusOptions = [
                        'open' => 'Aberto',
                        'in_negotiation' => 'Em Negociação',
                        'rejected' => 'Recusado',
                        'cancelled' => 'Cancelado',
                        ];
                        @endphp

                        @foreach ($statusOptions as $key => $label)
                        <option value="{{ $key }}" @selected(old('status', $serviceRequest->status) === $key)>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- Urgência --}}
                @php
                $urgencyValue = strtolower(old('urgency') ?? $serviceRequest->urgency ?? 'medium');
                @endphp

                <div>
                    <label class="block font-medium mb-2 text-gray-700">Urgência</label>
                    <select
                        name="urgency"
                        class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option disabled {{ $urgencyValue ? '' : 'selected' }}>Selecione...</option>
                        <option value="high" {{ $urgencyValue === 'high' ? 'selected' : '' }}>Alta</option>
                        <option value="medium" {{ $urgencyValue === 'medium' ? 'selected' : '' }}>Média</option>
                        <option value="low" {{ $urgencyValue === 'low' ? 'selected' : '' }}>Baixa</option>
                    </select>
                </div>

                {{-- Botões --}}
                <div class="flex justify-center gap-6 mt-8">
                    <a
                        href="{{ route('solicitacoes.index') }}"
                        class="border border-red-500 text-red-500 px-6 py-2 rounded-lg hover:bg-red-100 transition hover-scale">
                        Cancelar
                    </a>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition hover-scale">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </main>
    <x-footer />
</x-app-layout>