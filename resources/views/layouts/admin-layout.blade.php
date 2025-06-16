<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-900 text-white">
            <div class="p-6">
                <h2 class="text-xl font-bold">Painel do Administrador</h2>
                <p class="text-blue-200 text-sm">{{ Auth::user()->name }}</p>
            </div>
            
            <nav class="mt-6">
                <div class="px-6 py-2">
                    <span class="text-blue-200 text-xs uppercase tracking-wider">Menu Principal</span>
                </div>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-800 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.users') }}" 
                   class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-800 hover:text-white {{ request()->routeIs('admin.users') ? 'bg-blue-800 text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                    Gerenciar Clientes
                </a>
                
                <a href="{{ route('admin.service-requests') }}" 
                   class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-800 hover:text-white {{ request()->routeIs('admin.service-requests') ? 'bg-blue-800 text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 2a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                    Solicitações
                </a>
                
                <a href="{{ route('admin.reports') }}" 
                   class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-800 hover:text-white {{ request()->routeIs('admin.reports') ? 'bg-blue-800 text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                    Relatórios
                </a>
                
                <div class="border-t border-blue-700 mt-6 pt-6">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-800 hover:text-white">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0L2.586 11a2 2 0 010-2.828L6.293 4.465a1 1 0 011.414 1.414L4.414 9H17a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Voltar ao Site
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-6 py-3 text-blue-100 hover:bg-blue-800 hover:text-white">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                            </svg>
                            Sair
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-900">
                        {{ $header ?? 'Painel do Administrador' }}
                    </h1>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>