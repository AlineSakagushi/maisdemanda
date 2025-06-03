<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro Profissional - Demanda+</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#E3F1FF] font-sans">

  <!-- Cabeçalho -->
  <header class="bg-[#98D4FB] p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#0077C2]">Demanda+</h1>
    <div class="flex items-center gap-4 text-sm">
      <a href="#" class="hover:underline">Desejo Contratar</a>
      <a href="#" class="hover:underline">Desejo Trabalhar</a>
      <button class="bg-black text-white px-4 py-1 rounded-md">Login</button>
    </div>
  </header>

  <!-- Voltar -->
  <div class="mt-6 ml-6">
    <a href="{{ url('/') }}">
      <button class="bg-[#98D4FB] p-2 rounded-full">
        <span class="text-2xl">&#8592;</span>
      </button>
    </a>
  </div>

  <!-- Formulário de Cadastro Profissional -->
  <div class="flex justify-center items-center py-8">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md text-center">
      <h2 class="text-2xl font-semibold mb-6">CADASTRO PROFISSIONAL</h2>
      <form action="{{ route('profissional.store') }}" method="POST" class="space-y-4 text-left">
        @csrf
        <div>
          <label class="block mb-1 font-medium">Nome:</label>
          <input type="text" name="nome" class="w-full px-4 py-2 bg-gray-200 rounded" required />
        </div>
        <div>
          <label class="block mb-1 font-medium">CPF:</label>
          <input type="text" name="cpf" class="w-full px-4 py-2 bg-gray-200 rounded" required />
        </div>
        <div>
          <label class="block mb-1 font-medium">Email:</label>
          <input type="email" name="email" class="w-full px-4 py-2 bg-gray-200 rounded" required />
        </div>
        <div>
          <label class="block mb-1 font-medium">Senha:</label>
          <input type="password" name="senha" class="w-full px-4 py-2 bg-gray-200 rounded" required />
        </div>
        <div>
          <label class="block mb-1 font-medium">Confirmar senha:</label>
          <input type="password" name="senha_confirmation" class="w-full px-4 py-2 bg-gray-200 rounded" required />
        </div>
        <div>
          <label class="block mb-1 font-medium">Serviços Prestados:</label>
          <div class="flex">
            <input type="text" name="servico" class="w-full px-4 py-2 bg-gray-200 rounded-l" placeholder="ex: Eletricista, Pintor..." />
            <button type="button" class="bg-blue-600 text-white px-4 rounded-r hover:bg-blue-700 transition">Pesquisar</button>
          </div>
        </div>
        <div class="pt-4">
          <button type="submit" class="w-full bg-[#0077C2] text-white py-2 rounded hover:bg-blue-600 transition">
            CADASTRAR
          </button>
        </div>
      </form>
      <p class="mt-4 text-sm">Já tem login? <a href="{{ route('login') }}" class="text-red-500 hover:underline">Entrar</a></p>
    </div>
  </div>

  <!-- Rodapé -->
  <footer class="bg-[#98D4FB] text-black py-10 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
      <div class="flex space-x-4">
        <a href="#"><img src="https://img.icons8.com/ios-filled/20/x.png" alt="X"/></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/20/instagram-new.png" alt="Instagram"/></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/20/linkedin.png" alt="LinkedIn"/></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/20/youtube-play.png" alt="YouTube"/></a>
      </div>
      <div>
        <h4 class="font-bold mb-2">Use cases</h4>
        <ul>
          <li>UI design</li>
          <li>UX design</li>
          <li>Wireframing</li>
          <li>Diagramming</li>
          <li>Brainstorming</li>
          <li>Team collaboration</li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold mb-2">Explore</h4>
        <ul>
          <li>Design</li>
          <li>Prototyping</li>
          <li>Development features</li>
          <li>Design systems</li>
          <li>Figma</li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold mb-2">Resources</h4>
        <ul>
          <li>Blog</li>
          <li>Colors</li>
          <li>Support</li>
          <li>Developers</li>
          <li>Resource library</li>
        </ul>
      </div>
    </div>
  </footer>

</body>
</html>
