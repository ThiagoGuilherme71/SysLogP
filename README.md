# SysLog

Sistema de gerenciamento de logs e auditoria interna.

## 📋 Descrição

O **SysLog** é um sistema desenvolvido para monitorar, registrar e auditar atividades de sistemas e usuários, fornecendo maior controle e rastreabilidade para organizações.

## 🚀 Clonando o Projeto

Para clonar este repositório, execute o seguinte comando no seu terminal:

# Clonar o repositório
git clone https://github.com/ThiagoGuilherme71/SysLog.git

# Entrar na pasta do projeto
cd SysLog

# Instalar dependências PHP via Composer
composer install

# Copiar o arquivo .env de exemplo
cp .env.example .env

# Gerar a chave da aplicação Laravel
php artisan key:generate

# Rodar as migrações do banco de dados
php artisan migrate

# (Opcional) Rodar seeders para popular o banco
php artisan db:seed

# Iniciar o servidor de desenvolvimento Laravel
php artisan serve

# Rodar os testes automatizados (caso existam)
php artisan test

