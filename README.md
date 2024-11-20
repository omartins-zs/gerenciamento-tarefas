
# Gerenciador de Tarefas

Um sistema simples para gerenciar tarefas, com controle de acesso para usuários e administradores.

---

## Tecnologias

- [Laravel 11.x](https://laravel.com/)
- [PHP 8.2](https://www.php.net/)
- [MySQL 8.x](https://www.mysql.com/)
- [Tailwind CSS](https://tailwindcss.com/)

  
---

## Pré-requisitos

- PHP >= 8.1
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) >= 16.x
- [Herd](https://herd.laravel.com/windows)

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

3. Configure o `.env`:

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

---

## Como Usar

1. Acesse o sistema em `http://localhost:8000`.
2. Registre-se como usuário ou faça login como administrador:
   - **Admin**: **admin@example.com** / senha: **password**
   - **Usuário**: **user@example.com** / senha: **password**

---

## Funcionalidades

- Gerenciamento de tarefas
- Controle de acesso para diferentes tipos de usuários (Admin e Usuário)
- Testes automatizados com PHPUnit
- Uso de **factories** e **seeders** para população do banco de dados
- **Policies**: Autorização baseada em políticas para diferentes operações no sistema.
- **Filtros**: Filtros para acessar e processar informações específicas.
- **Ordenação**: Permite ordenar listas de tarefas conforme critérios definidos.
- **Validações**: Validação de dados no momento da criação e atualização de tarefas.

---

## Documentação de Banco de Dados

####  Estrutura de Banco de Dados
1. **users**:
   - `id`: Chave primária.
   - `name`: Nome do usuário.
   - `email`: E-mail do usuário.
   - `role`: Papel do usuário (admin ou user).

2. **tasks**:
   - `id`: Chave primária.
   - `user_id`: Chave estrangeira para `users`.
   - `title`: Título da tarefa.
   - `status`: Status da tarefa (pendente, em andamento, concluída).

---

  <section class="py-6 text-center">
    <img src="/DocumentacaoEstruturaBD.png" alt="Documentação Estrutura BD" class="mx-auto">
  </section>

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

---

## Testes Automatizados

Este projeto utiliza o **PHPUnit** para os testes automatizados. Para rodar todos os testes, utilize o seguinte comando:

```bash
php artisan test
```

### Rodar Testes Específicos

Para rodar um teste específico de um arquivo ou classe de teste, você pode usar a opção `--filter`:

```bash
php artisan test --filter NomeDoTeste
```

---

## Executando Seeders

Para popular o banco de dados com dados iniciais ou de teste, execute o seguinte comando:

```bash
php artisan db:seed
```

### Rodar Seeder Específico

Caso queira rodar um seeder específico (por exemplo, o seeder de `Tasks`), utilize o comando:

```bash
php artisan db:seed --class=NomeDoSeeder
```

---

## MVC e Padrão Arquitetural

O projeto segue o padrão MVC (Model-View-Controller):

- **Model**: Lida com o acesso aos dados e interações com a camada de persistência. Representa as entidades `Task` e `User`.
- **View**: Contém a interface do usuário, as views de listagem de tarefas, detalhes, formulário de criação e edição.
- **Controller**: Define as ações possíveis e métodos para manipular as operações relacionadas às tarefas.

---

Caso tenha qualquer dúvida ou necessidade adicional, sinta-se à vontade para perguntar!
