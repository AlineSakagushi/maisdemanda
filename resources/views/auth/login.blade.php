<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md fade-in">
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-blue-600">Demanda+</h1>
                <p class="text-gray-600 mt-1">Bem-vindo(a) de volta! Faça login para continuar.</p>
            </div>

            <!-- Status da sessão -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('E-mail')" class="text-gray-700 font-medium" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Senha -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Senha')" class="text-gray-700 font-medium" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Lembrar -->
                <div class="flex items-center mb-4">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                        name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">
                        {{ __('Lembre-se de mim') }}
                    </label>
                </div>

                <!-- Ações -->
                <div class="flex flex-col gap-3">
                    <x-primary-button class="w-full bg-blue-600 hover:bg-blue-700">
                        {{ __('Entrar') }}
                    </x-primary-button>

                    <div class="flex justify-between text-sm">
                        @if (Route::has('password.request'))
                        <a class="text-gray-600 hover:text-blue-600" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                        @endif

                        <a class="text-gray-600 hover:text-blue-600" href="{{ route('register') }}">
                            {{ __('Criar conta') }}
                        </a>
                    </div>
                </div>
            </form>
</x-guest-layout>