# Projeto 1 – API de Lista de Tarefas

## Objetivo

Este projeto tem como objetivo o desenvolvimento de uma API REST utilizando **Laravel 13**, seguindo boas práticas de arquitetura, autenticação, autorização e testes automatizados com **PHPUnit**.

A aplicação permitirá o gerenciamento de tarefas pessoais por usuários autenticados, além de disponibilizar funcionalidades administrativas para gerenciamento global do sistema.

O foco deste projeto é consolidar conhecimentos em:

* Laravel 13
* APIs RESTful
* Autenticação e autorização
* Policies e Gates
* Testes automatizados com PHPUnit
* Validação de dados
* Relacionamentos entre entidades
* Controle de acesso baseado em perfis (RBAC)
* Tratamento de erros e respostas padronizadas

---

## Perfis de Usuário

O sistema possuirá três níveis de acesso:

### 1. Visitante (Guest)

Usuários não autenticados poderão:

* Criar uma nova conta de usuário comum;
* Realizar login no sistema;
* Solicitar recuperação de senha através do recurso **"Esqueci minha senha"**;
* Redefinir a senha utilizando o token de recuperação.

---

### 2. Usuário Comum

Usuários autenticados com perfil comum poderão gerenciar apenas suas próprias tarefas.

#### Funcionalidades

* Criar uma nova tarefa;
* Listar todas as suas tarefas;
* Visualizar os detalhes de uma tarefa específica;
* Editar uma tarefa criada por ele;
* Marcar uma tarefa como concluída;
* Reabrir uma tarefa concluída;
* Excluir uma tarefa;
* Filtrar tarefas por status (pendente/concluída);
* Pesquisar tarefas por título.
* Visualizar seus próprios dados de cadastro
* Editar seus dados de cadastro

---

### 3. Administrador

Usuários com perfil de administrador terão acesso completo ao sistema.

#### Gerenciamento de Usuários

* Listar todos os usuários cadastrados;
* Visualizar os dados de um usuário específico;
* Criar usuários;
* Editar informações de usuários;
* Excluir usuários.

#### Gerenciamento de Tarefas

* Visualizar todas as tarefas do sistema;
* Listar tarefas de um usuário específico;
* Visualizar detalhes de qualquer tarefa;
* Criar tarefas para qualquer usuário;
* Editar tarefas de qualquer usuário;
* Marcar qualquer tarefa como concluída;
* Reabrir tarefas concluídas;
* Excluir qualquer tarefa.

---

## Regras de Negócio

* Cada tarefa pertence a apenas um usuário;
* Usuários comuns só podem acessar suas próprias tarefas;
* Administradores podem acessar e gerenciar todas as tarefas;
* Apenas usuários autenticados podem manipular tarefas;
* O título da tarefa é obrigatório;
* Tarefas devem possuir um status (*Pendente* ou *Concluída*);
* A API deve retornar códigos HTTP adequados para cada operação.

---

## Testes Automatizados

O projeto deverá possuir cobertura de testes utilizando **PHPUnit**, contemplando:

### Testes de Autenticação

* Cadastro de usuário;
* Login;
* Recuperação de senha;
* Controle de acesso a rotas protegidas.

### Testes de Tarefas

* Criação de tarefas;
* Edição de tarefas;
* Exclusão de tarefas;
* Listagem de tarefas;
* Alteração de status;
* Restrições de acesso entre usuários.

### Testes Administrativos

* Gerenciamento de usuários;
* Gerenciamento global de tarefas;
* Verificação das permissões de administrador.

---

## Desafio Extra (Opcional)

Implementar recursos adicionais para aumentar a complexidade do projeto:

* Paginação de resultados;
* Ordenação de tarefas;
* Soft Deletes;
* Logs de atividades;
* Documentação da API com Swagger/OpenAPI;
* Dockerização da aplicação;
* Integração contínua (GitHub Actions);
* Cobertura mínima de testes superior a 80%.

---

### Resultado Esperado

Ao final do projeto, o desenvolvedor terá construído uma API completa de gerenciamento de tarefas utilizando Laravel 13, aplicando conceitos fundamentais de desenvolvimento backend, autenticação, autorização, testes automatizados e boas práticas de engenharia de software.


## Dica para melhorar os commits

Uma forma profissional de fazer commits é seguir três princípios:

1. **Cada commit deve representar uma única mudança lógica.**
2. **A mensagem deve explicar o que foi alterado.**
3. **O histórico deve ser fácil de entender meses depois.**

## Estrutura recomendada (Conventional Commits)

Use o padrão:

```text
tipo(escopo): descrição curta
```

### Exemplos

```bash
git commit -m "feat(auth): implement user login endpoint"
```

```bash
git commit -m "fix(tasks): correct task status validation"
```

```bash
git commit -m "test(auth): add login request validation tests"
```

```bash
git commit -m "refactor(user): simplify user creation service"
```

```bash
git commit -m "docs(api): update authentication documentation"
```

---

## Tipos mais utilizados

| Tipo     | Quando usar                           |
| -------- | ------------------------------------- |
| feat     | Nova funcionalidade                   |
| fix      | Correção de bug                       |
| refactor | Refatoração sem alterar comportamento |
| test     | Inclusão ou alteração de testes       |
| docs     | Documentação                          |
| style    | Formatação, lint, identação           |
| chore    | Tarefas de manutenção                 |
| perf     | Melhoria de performance               |
| ci       | Pipeline CI/CD                        |
| build    | Dependências ou build                 |

---

## Exemplo para o projeto Laravel

### Cadastro de usuário

```bash
git commit -m "feat(auth): implement user registration"
```

### Testes de cadastro

```bash
git commit -m "test(auth): add registration validation tests"
```

### Login

```bash
git commit -m "feat(auth): implement user authentication"
```

### Testes de login

```bash
git commit -m "test(auth): add login endpoint tests"
```

### CRUD de tarefas

```bash
git commit -m "feat(tasks): implement task CRUD operations"
```

### Policies

```bash
git commit -m "feat(tasks): add authorization policies"
```

---
