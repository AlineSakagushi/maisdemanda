# Requisitos

- PHP 8.2 ou superior;
- MySQL 8 ou superior;
- Composer;
- Node.js 20 ou superior;
- Docker;
- Docker Compose;

# Como rodar o projeto baixado

Duplicar o arquivo ".env.example" e renomear para ".env".
Alterar no arquivo .env as credenciais do banco de dados.
(Certifique-se que o usuário utilizado tem permissão para criar trigger e procedures no banco de dados)

## Instalar as dependências do PHP.

```sh
composer install
```

Instalar as dependências do Node.js.

```sh
npm install
```

Gerar a chave.

```sh
php artisan key:generate
```

Executar as migration para criar a base de dados e as tabelas.

```sh
php artisan migrate
```

Executar as seeds para cadastro do usuário admin no banco de dados e popular as categorias de serviços.

Usuário: [admin@email.com](mailto:admin@email.com)
Senha: password 

```sh
php artisan db:seed 
```

Iniciar o projeto criado com Laravel.

```sh
php artisan serve
```

Executar as bibliotecas Node.js.

```sh
npm run dev
```

## Instalar as dependencias do banco de dados (Opicional)

Considerando que o docker e o docker-compose estejam previamente instalados.

```sh
 docker-compose up -d
```


Acessar no navegador a URL com o conteúdo padrão do Laravel.

```
<http://127.0.0.1:8000>
```

Traduzir para português [Módulo de linguagem pt-BR](https://github.com/lucascudo/laravel-pt-BR-localization).
