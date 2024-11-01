# Gerenciador de Projetos e Tarefas - API REST

Este projeto é uma API RESTful desenvolvida com Laravel para gerenciar projetos e tarefas, permitindo a criação, leitura, atualização e exclusão (CRUD) de ambos. A API inclui funcionalidades de associação automática entre tarefas e projetos, com documentação completa utilizando Swagger.

## Tabela de Conteúdos

- [Funcionalidades](#funcionalidades)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Documentação da API](#documentação-da-api)
- [Endpoints](#endpoints)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Contribuição](#contribuição)
- [Licença](#licença)

---

## Funcionalidades

- CRUD completo para **Projetos** e **Tarefas**.
- Associação automática de tarefas ao projeto correspondente.
- Validação de dados de entrada para segurança e integridade.
- Documentação da API com **Swagger**.

## Instalação

1. **Clone o repositório**:
    ```bash
    git clone https://github.com/seu-usuario/nome-do-repositorio.git
    cd nome-do-repositorio
    ```

2. **Instale as dependências do projeto**:
    ```bash
    composer install
    npm install
    ```

3. **Configure o arquivo `.env`** com as credenciais do banco de dados:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha
    ```

4. **Execute as migrações** para criar as tabelas:
    ```bash
    php artisan migrate
    ```

5. **Inicie o Vite**:
    ```bash
    npm rum dev
    ```

6. **Inicie o servidor local**:
    ```bash
    php artisan serve
    ```

## Configuração

Para documentar e acessar os endpoints da API com Swagger:

1. Instale o Swagger Lume:
    ```bash
    composer require darkaonline/swagger-lume
    php artisan swagger-lume:publish
    ```

2. Acesse a documentação em `http://localhost:8000/api/documentation` após iniciar o servidor.

## Documentação da API

A API oferece suporte aos seguintes endpoints principais para Projetos e Tarefas. A documentação detalhada pode ser acessada via Swagger.

### Endpoints

#### Projetos

- `GET /api/projects` - Listar todos os projetos.
- `POST /api/projects` - Criar um novo projeto.
- `GET /api/projects/{id}` - Detalhar um projeto específico.
- `PUT /api/projects/{id}` - Atualizar um projeto.
- `DELETE /api/projects/{id}` - Remover um projeto.

#### Tarefas

- `GET /api/tasks` - Listar todas as tarefas.
- `POST /api/projects/{project_id}/tasks` - Criar uma nova tarefa associada a um projeto.
- `GET /api/tasks/{id}` - Detalhar uma tarefa específica.
- `PUT /api/tasks/{id}` - Atualizar uma tarefa.
- `DELETE /api/tasks/{id}` - Remover uma tarefa.

## Estrutura do Projeto

A estrutura de pastas do projeto segue as convenções do Laravel, com destaque para:

- `app/Http/Controllers` - Controladores da API.
- `app/Http/Requests` - Validação de dados de entrada.
- `app/Services` - Lógica de negócio para projetos e tarefas.
- `routes/api.php` - Definição de rotas para os endpoints da API.

## Tecnologias Utilizadas

- **Laravel** - Framework PHP.
- **MySQL** - Banco de dados.
- **Swagger** - Documentação da API.
- **Composer** - Gerenciador de dependências.
- **Insomnia** - Teste da API.

## Contribuição

Contribuições são bem-vindas! Para contribuir, siga estas etapas:

1. Faça um fork do projeto.
2. Crie uma nova branch para sua funcionalidade (`git checkout -b minha-nova-funcionalidade`).
3. Commit suas alterações (`git commit -m 'Adiciona nova funcionalidade'`).
4. Faça o push para a branch (`git push origin minha-nova-funcionalidade`).
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
