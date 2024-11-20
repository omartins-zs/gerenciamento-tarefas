# Gerenciador de Tarefas

Um sistema simples para gerenciar tarefas, com controle de acesso para usuários e administradores.

---

## Tecnologias

- Laravel 11.x
- PHP 8.2
- MySQL 8.x
- Tailwind CSS

---

## Pré-requisitos

- PHP >= 8.1
- Composer
- Node.js >= 16.x

---
## Instalação

1. Clone o repositório:
  ```bash
   git clone https://github.com/seu-repo.git
   cd seu-projeto
```
2. Instale as dependências:

  ```bash
composer install
npm install
npm run dev
```

3. Configure o .env:

  ```bash
cp .env.example .env
php artisan key:generate
```

4. Configure o banco de dados e execute as migrations:

  ```bash
php artisan migrate
```

5. Inicie o servidor:

  ```bash
php artisan serve
```

## Como Usar

1. Acesse o sistema em `http://localhost:8000`.
2. Registre-se como usuário ou faça login como administrador:
   - Admin: **admin@example.com / senha**

## Documentação de Rotas
| Método | URL                                | Ação                                | Middleware         |
|--------|------------------------------------|-------------------------------------|--------------------|
| GET    | /tasks                             | Lista as tarefas                    | auth               |
| POST   | /tasks                             | Cria uma nova tarefa                | auth               |
| GET    | /tasks/create                      | Exibe formulário para criação       | auth               |
| GET    | /tasks/{task}                      | Exibe detalhes da tarefa            | auth               |
| PUT    | /tasks/{task}                      | Atualiza tarefa                     | auth               |
| DELETE | /tasks/{task}                      | Exclui tarefa                       | auth, is_admin     |
| GET    | /tasks/{task}/edit                 | Exibe formulário de edição          | auth               |
| PUT    | /dashboard/update-role/{user}      | Atualiza role do usuário            | auth, is_admin     |
| GET    | /dashboard                         | Exibe a dashboard                   | auth               |
| GET    | /login                             | Exibe formulário de login           | guest              |
| POST   | /login                             | Realiza login                       | guest              |
| POST   | /logout                            | Realiza logout                      | auth               |
| GET    | /register                          | Exibe formulário de registro        | guest              |
| POST   | /register                          | Realiza o registro de um novo usuário | guest            |
