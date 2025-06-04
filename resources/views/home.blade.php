<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Demanda+ - Serviços Profissionais</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
</head>
<body class="bg-blue-100 min-h-screen flex flex-col">

    <!-- Header com fundo branco -->
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <h1 class="text-3xl font-bold text-blue-600">Demanda+</h1>
                </div>
                <nav class="hidden md:flex items-center space-x-4">
    <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Desejo contratar</a>
    <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors font-medium">Desejo trabalhar</a>
    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">Login</a>
</nav>

            </div>
        </div>
    </header>

    <!-- Banner Hero -->
    <section class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-8">
            <div class="text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Conectamos você aos melhores profissionais</h2>
                <p class="text-xl text-gray-600 mb-6">Serviços de qualidade com profissionais qualificados perto de você</p>
                <div class="flex justify-center space-x-4">
                    <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-medium">✓ Profissionais Verificados</span>
                    <span class="bg-white border text-gray-600 px-4 py-2 rounded-full text-sm font-medium">✓ Atendimento 24h</span>
                    <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-medium">✓ Garantia de Qualidade</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto p-6 flex gap-8">
        <!-- Conteúdo Principal -->
        <div class="w-2/3">
            <div class="bg-white shadow-lg rounded-xl p-8 fade-in">
                <div class="flex items-center mb-6">
                    <span class="text-3xl mr-3 text-yellow-400">⭐</span>
                    <h2 class="text-2xl font-bold text-gray-800">Serviços em Destaque</h2>
                </div>
                <p class="text-gray-600 mb-8">Descubra os serviços mais solicitados na sua região com profissionais altamente qualificados!</p>

                <!-- Lista de Serviços -->
                <div class="space-y-6">
                    <!-- Serviço 1 -->
                    <div class="service-card border rounded-xl p-6 flex gap-6 hover-scale cursor-pointer">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=150&h=150&fit=crop&crop=center" 
                                 alt="Técnico de Ar-Condicionado" 
                                 class="w-32 h-32 object-cover rounded-lg shadow-md" />
                            <div class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">Disponível</div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-xl font-bold text-gray-800">Técnico em Ar-Condicionado</h3>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 mr-1">⭐</span>
                                    <span class="text-sm font-medium text-gray-600">4.8</span>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-4">Instalação, manutenção e conserto de sistemas de climatização residencial e comercial. Atendimento emergencial 24h.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-4 text-sm text-gray-500">
                                    <span>📍 Até 5km</span>
                                    <span>💰 A partir de R$ 80</span>
                                    <span>⏱️ Resposta em 30min</span>
                                </div>
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                    Solicitar Serviço
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Serviço 2 -->
                    <div class="service-card border rounded-xl p-6 flex gap-6 hover-scale cursor-pointer">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=150&h=150&fit=crop&crop=center" 
                                 alt="Encanador Profissional" 
                                 class="w-32 h-32 object-cover rounded-lg shadow-md" />
                            <div class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">Disponível</div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-xl font-bold text-gray-800">Serviços Hidráulicos</h3>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 mr-1">⭐</span>
                                    <span class="text-sm font-medium text-gray-600">4.9</span>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-4">Encanamento, desentupimento, instalação de torneiras e chuveiros. Especialista em vazamentos e emergências.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-4 text-sm text-gray-500">
                                    <span>📍 Até 8km</span>
                                    <span>💰 A partir de R$ 60</span>
                                    <span>⏱️ Resposta em 20min</span>
                                </div>
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                    Solicitar Serviço
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Serviço 3 -->
                    <div class="service-card border rounded-xl p-6 flex gap-6 hover-scale cursor-pointer">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=150&h=150&fit=crop&crop=center" 
                                 alt="Diarista Profissional" 
                                 class="w-32 h-32 object-cover rounded-lg shadow-md" />
                            <div class="absolute -top-2 -right-2 bg-yellow-400 text-white text-xs px-2 py-1 rounded-full">Muito Procurado</div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-xl font-bold text-gray-800">Limpeza Residencial</h3>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 mr-1">⭐</span>
                                    <span class="text-sm font-medium text-gray-600">4.7</span>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-4">Limpeza completa, organização, faxina pesada e manutenção residencial. Produtos inclusos no serviço.</p>
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-4 text-sm text-gray-500">
                                    <span>📍 Até 10km</span>
                                    <span>💰 A partir de R$ 120</span>
                                    <span>⏱️ Agendamento flexível</span>
                                </div>
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                    Solicitar Serviço
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="w-1/3">
            <!-- Profissionais em Destaque -->
            <div class="bg-white shadow-lg rounded-xl p-6 mb-6 fade-in">
                <div class="flex items-center mb-6">
                    <span class="text-2xl mr-3">👨‍🔧</span>
                    <h2 class="text-xl font-bold text-gray-800">Profissionais Top</h2>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center p-3 bg-blue-100 rounded-lg hover:bg-blue-200 transition-colors cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face" 
                             alt="Carlos Silva" 
                             class="w-12 h-12 rounded-full object-cover mr-4" />
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-gray-800">Carlos Silva</p>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-sm mr-1">⭐</span>
                                    <span class="text-sm font-medium text-gray-600">4.9</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600">Encanador • 8 anos exp.</p>
                            <p class="text-xs text-blue-600 font-medium">🟢 Disponível agora</p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 bg-blue-100 rounded-lg hover:bg-blue-200 transition-colors cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=60&h=60&fit=crop&crop=face" 
                             alt="Ana Costa" 
                             class="w-12 h-12 rounded-full object-cover mr-4" />
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-gray-800">Ana Costa</p>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-sm mr-1">⭐</span>
                                    <span class="text-sm font-medium text-gray-600">4.8</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600">Diarista • 5 anos exp.</p>
                            <p class="text-xs text-blue-600 font-medium">🟢 Disponível hoje</p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 bg-blue-100 rounded-lg hover:bg-blue-200 transition-colors cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&h=60&fit=crop&crop=face" 
                             alt="Roberto Santos" 
                             class="w-12 h-12 rounded-full object-cover mr-4" />
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-gray-800">Roberto Santos</p>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-sm mr-1">⭐</span>
                                    <span class="text-sm font-medium text-gray-600">5.0</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600">Técnico AC • 12 anos exp.</p>
                            <p class="text-xs text-gray-500 font-medium">🟠 Muito ocupado</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget de Estatísticas -->
            <div class="bg-white shadow-lg rounded-xl p-6 fade-in">
                <h3 class="text-lg font-bold mb-4 text-blue-600">🎯 Nossa Performance</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Serviços Realizados</span>
                        <span class="font-bold text-xl text-gray-800">12,845+</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Clientes Satisfeitos</span>
                        <span class="font-bold text-xl text-gray-800">98.5%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Tempo Médio Resposta</span>
                        <span class="font-bold text-xl text-gray-800">< 30min</span>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <!-- Footer-->
<x-footer />

    <script>
        // Adicionar interatividade
        document.addEventListener('DOMContentLoaded', function() {
            // Efeito de fade-in ao carregar
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.2}s`;
            });

            // Funcionalidade dos botões
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.textContent.includes('Solicitar Serviço')) {
                        e.preventDefault();
                        // Simulação de ação
                        const originalText = this.textContent;
                        this.textContent = 'Conectando...';
                        this.disabled = true;
                        
                        setTimeout(() => {
                            this.textContent = '✓ Solicitado!';
                            this.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                            this.classList.add('bg-blue-600');
                            
                            setTimeout(() => {
                                this.textContent = originalText;
                                this.disabled = false;
                                this.classList.remove('bg-blue-600');
                                this.classList.add('bg-blue-600', 'hover:bg-blue-700');
                            }, 2000);
                        }, 1500);
                    }
                });
            });
        });
    </script>

</body>
</html>