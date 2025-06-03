<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Solicitação de Serviço
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded p-6">

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('solicitacoes.update', $serviceRequest->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="title">Título</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $serviceRequest->title) }}" class="border-gray-300 rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="description">Descrição</label>
                    <textarea name="description" id="description" class="border-gray-300 rounded w-full" rows="3">{{ old('description', $serviceRequest->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="category">Serviço</label>
                    <select name="category" id="category" class="border-gray-300 rounded w-full" required>
                        <option value="">Selecione um serviço</option>
                        @foreach (['Encanador', 'Eletricista', 'Carpinteiro'] as $service)
                            <option value="{{ $service}}" @selected(old('service', $serviceRequest->service) == $service)>{{ $service }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="expected_budget">Orçamento Esperado (R$)</label>
                    <input type="number" name="expected_budget" id="expected_budget" value="{{ old('expected_budget', $serviceRequest->expected_budget) }}" step="0.01" min="0" class="border-gray-300 rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="desired_date">Data Desejada</label>
                    <input type="date" name="desired_date" id="desired_date" value="{{ old('desired_date', $serviceRequest->desired_date?->format('Y-m-d')) }}" class="border-gray-300 rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="status">Status</label>
                    <select name="status" id="status" class="border-gray-300 rounded w-full" required>
                        @foreach(['open', 'in_negotiation', 'closed', 'cancelled'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $serviceRequest->status) === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="urgency">Urgência</label>
                    <input type="text" name="urgency" id="urgency" value="{{ old('urgency', $serviceRequest->urgency) }}" class="border-gray-300 rounded w-full">
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('solicitacoes.index') }}" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</a>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
