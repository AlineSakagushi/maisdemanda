<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Service Request
        </h2>
    </x-slot>

    <main class="flex-1 px-6 py-10 bg-blue-50">
        <h2 class="text-2xl font-semibold text-center mb-8">Service Request Form</h2>

        <form action="{{ route('solicitacoes.store') }}" method="POST" class="max-w-xl mx-auto space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label class="block font-medium mb-1">Title</label>
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
                <label class="block font-medium mb-1">Description</label>
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
                    <label class="block font-medium mb-1">Category</label>
                    <select 
                        name="category" 
                        class="w-full border rounded p-2 shadow-sm" 
                        required
                    >
                        <option disabled selected>Select...</option>
                        <option value="plumbing">Plumbing</option>
                        <option value="electrical">Electrical</option>
                        <option value="cleaning">Cleaning</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block font-medium mb-1">Date</label>
                    <input 
                        type="date" 
                        name="date" 
                        class="w-full border rounded p-2 shadow-sm" 
                        required
                    />
                </div>
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
