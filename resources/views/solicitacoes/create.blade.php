<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Service Request
        </h2>
    </x-slot>

    <main class="flex-1 px-6 py-10 bg-blue-50">
        <h2 class="text-2xl font-semibold text-center mb-8">Solicitação de Serviço </h2>

        <form action="{{ route('solicitacoes.store') }}" method="POST" class="max-w-xl mx-auto space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label class="block font-medium mb-1">Título</label>
                <input 
                    type="text" 
                    name="title" 
                    placeholder="Title..." 
                    class="w-full border rounded p-2 shadow-sm" 
                    required
                />
            </div>

            {{-- Description --}}
            <div>
                <label class="block font-medium mb-1">Descrição</label>
                <textarea 
                    name="description" 
                    placeholder="Describe the service you need" 
                    rows="4" 
                    class="w-full border rounded p-2 shadow-sm"
                    required
                ></textarea>
            </div>

            {{-- Category + Date --}}
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block font-medium mb-1">Categoria</label>
                    <select 
                        name="service_category_id" 
                        class="w-full border rounded p-2 shadow-sm" 
                        required
                    >
                        <option disabled selected>Selecione...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block font-medium mb-1">Data</label>
                    <input 
                        type="date" 
                        name="desired_date" 
                        class="w-full border rounded p-2 shadow-sm" 
                        required
                    />
                </div>
            </div>

            {{-- Expected Budget --}}
            <div>
                <label class="block font-medium mb-1">Valor Esperado (R$)</label>
                <input 
                    type="number" 
                    name="expected_budget" 
                    placeholder="e.g. 500.00" 
                    step="0.01" 
                    min="0" 
                    class="w-full border rounded p-2 shadow-sm" 
                    required
                />
            </div>

            {{-- Status --}}
            <div>
                <label class="block font-medium mb-1">Status</label>
                <select 
                    name="status" 
                    class="w-full border rounded p-2 shadow-sm" 
                    required
                >
                    <option value="open" selected>Open</option>
                    <option value="in_negotiation">In Negotiation</option>
                    <option value="closed">Closed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            {{-- Urgency --}}
            <div>
                <label class="block font-medium mb-1">Urgency</label>
                <input 
                    type="text" 
                    name="urgency" 
                    placeholder="e.g. High, Medium, Low" 
                    class="w-full border rounded p-2 shadow-sm"
                />
            </div>

            {{-- Buttons --}}
            <div class="flex justify-center gap-4 mt-6">
                <a 
                    href="{{ route('dashboard') }}" 
                    class="border border-red-500 text-red-500 px-6 py-2 rounded hover:bg-red-100"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700"
                >
                    Submit
                </button>
            </div>
        </form>
    </main>
</x-app-layout>
