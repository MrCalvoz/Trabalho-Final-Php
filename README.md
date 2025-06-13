# Sistema de Gerenciamento de Tarefas Pessoais

Um sistema web para gerenciamento de tarefas pessoais desenvolvido em PHP com MySQL.

## Recursos

- Cadastro de usuários
- Autenticação segura com sessões
- CRUD completo de tarefas
- Dashboard com estatísticas
- Interface responsiva

## Requisitos

- PHP 7.0 ou superior
- MySQL 5.6 ou superior
- Servidor web (Apache, Nginx, etc.)

## Instalação

1. Importe o banco de dados executando o script `sql/criar_banco.sql`
2. Configure as credenciais do banco no arquivo `includes/conexao.php`
3. Coloque os arquivos no diretório público do seu servidor web

## Dados de Teste

Usuário de teste:
- Login: teste
- Senha: 123456

## Melhorias Futuras

- Adicionar prioridade às tarefas
- Implementar sistema de categorias
- Adicionar busca e filtros
- Implementar lembretes por e-mail