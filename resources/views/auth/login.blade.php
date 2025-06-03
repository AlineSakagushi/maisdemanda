<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Demanda+</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#E4F1FD] flex flex-col">

  <!-- Cabeçalho -->
  <header class="bg-blue-400 text-white w-full p-4 flex justify-between items-center">
    <a href="/" class="text-2xl font-bold hover:underline">Demanda+</a>
    <div class="flex items-center space-x-2 cursor-pointer hover:opacity-90 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1116.95 6.05m-4.243 8.486L21 21" />
      </svg>
      <span class="text-sm font-medium">Usuário</span>
    </div>
  </header>

  <!-- Conteúdo central -->
  <main class="flex-grow flex justify-center items-center px-4 py-10">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
      <!-- Segurança visual -->
      <div class="flex items-center justify-center mb-4 text-green-600 text-sm">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M12 11c1.1 0 2 .9 2 2v2h-4v-2c0-1.1.9-2 2-2z"/><path d="M17 11V7a5 5 0 00-10 0v4m-1 0h12a2 2 0 012 2v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5a2 2 0 012-2z"/>
        </svg>
        Conexão segura
      </div>

      <h2 class="text-2xl font-bold text-center mb-6 text-blue-500">Login</h2>

      <form>
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-1" for="email">E-mail</label>
          <input
            type="email"
            id="email"
            required
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="seuemail@exemplo.com"
          />
        </div>

        <div class="mb-6 relative">
          <label class="block text-gray-700 font-semibold mb-1" for="password">Senha</label>
          <input
            type="password"
            id="password"
            required
            class="w-full border border-gray-300 rounded-md px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="********"
          />
          <!-- botão mostrar/ocultar -->
          <button type="button" class="absolute top-9 right-3 text-gray-500" onclick="togglePassword()">
            
          </button>
        </div>

        <button
          type="submit"
          class="bg-[#F55640] text-white w-full py-2 rounded-md font-semibold hover:bg-red-600 transition"
        >
          Entrar
        </button>
      </form>

      <p class="text-sm text-gray-600 text-center mt-4">
        Ainda não tem uma conta?
        <a href="/cadastro" class="text-blue-500 hover:underline">Cadastre-se</a>
      </p>

      <!-- Login social opcional (comentado para futura expansão) -->
      <!--
      <div class="mt-6">
        <button class="w-full py-2 border rounded-md flex items-center justify-center space-x-2 hover:bg-gray-100">
          <img src="https://www.google.com/favicon.ico" class="w-4 h-4" />
          <span>Entrar com Google</span>
        </button>
      </div>
      -->
    </div>
  </main>

  <!-- Rodapé -->
  <footer class="bg-blue-400 text-white p-4 text-center text-sm">
    &copy; 2025 Demanda+. Todos os direitos reservados.
  </footer>

  <!-- Script para alternar visibilidade da senha -->
  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      input.type = input.type === 'password' ? 'text' : 'password';
    }
  </script>

</body>
</html>
