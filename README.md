# 📘 Sistema de CRUD - Projeto Integrador (PI)

![PHP](https://img.shields.io/badge/PHP-8+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)
![MVC](https://img.shields.io/badge/Arquitetura-MVC-blue)
![License](https://img.shields.io/badge/License-Projeto%20Acadêmico-green)
![Status](https://img.shields.io/badge/Status-Concluído-brightgreen)

Este projeto é um sistema web de **Gestão de TI**, desenvolvido como
parte do **Projeto Integrador** do curso de **Desenvolvimento de
Software Multiplataforma - Fatec Jahu**.

O sistema implementa um CRUD completo para **Usuários** e **Produtos**,
seguindo arquitetura **MVC**, uso de **PDO**, e boas práticas de
organização e segurança.

------------------------------------------------------------------------

## 🚀 Funcionalidades

### 👥 Gestão de Usuários

-   Cadastro com validação
-   Listagem com ocultação de usuários excluídos (soft delete)
-   Edição inteligente (senha opcional)
-   **Soft Delete:** exclusão lógica
-   **Hard Delete:** exclusão física definitiva

### 📦 Gestão de Produtos

-   Edição e exclusão seguindo os mesmos padrões de segurança
-   Listagem com ocultação de produtos excluídos (soft delete)
-   **Soft Delete:** exclusão lógica
-   **Hard Delete:** exclusão física definitiva

------------------------------------------------------------------------

## 🛠️ Tecnologias Utilizadas

-   **PHP 8+**
-   **MySQL**
-   **PDO (PHP Data Objects)**
-   **Composer (Autoload)**
-   **HTML5 / CSS3 / Bootstrap**
-   **Git / GitHub**
-   **MySQL Workbench**

------------------------------------------------------------------------

## ⚙️ Estrutura do Projeto (MVC)

    app/
     ├── Models/        # Lógica de banco de dados (CRUD)
     ├── Controllers/   # Liga rotas às Views e Models
     ├── Views/         # Interface do usuário
     └── Core/          # Configurações centrais (Database, Autoload)

    public/             # Ponto de entrada (index.php) + assets
    database/           # Script SQL
    vendor/             # Dependências via Composer

------------------------------------------------------------------------

## 🔧 Como Executar

### 1️⃣ Clone o repositório

``` bash
git clone https://github.com/ImEXPLO/LojaNipen-PI.git
```

### 2️⃣ Instale as dependências

``` bash
composer install
```

### 3️⃣ Configure o banco de dados

-   Crie o banco **loja_nipen**
-   Importe o arquivo `database/script.sql`
-   Verifique as credenciais em:


```
    app/Core/Database.php
```

### 4️⃣ Inicie o servidor embutido do PHP

``` bash
php -S localhost:8000 -t public
```

### 5️⃣ Acesse no navegador

👉 http://localhost:8000

------------------------------------------------------------------------

## 📚 Referências Acadêmicas

O projeto foi construído com base nos conteúdos apresentados em aula e
no repositório oficial:

> [*GitHub DSM - Fatec Jahu*](https://github.com/DSM-Fatec-Jahu/aulas-pi.git)

------------------------------------------------------------------------

## 🤖 Uso de Inteligência Artificial

Ferramentas de IA (como Google Gemini e o Perplexity) foram utilizadas como apoio ao
**aprendizado**, e não como geradores automáticos de código.

Auxiliaram em: - Compreensão de MVC, PDO e OOP\
- Depuração de erros
- Organização de código (Clean Code)
- Estruturação de rotas e Soft Delete

Todo o código foi **compreendido, revisado e testado** pelos
desenvolvedores, além de **totalmente comentado** pelos próprios.

------------------------------------------------------------------------

## 👥 Desenvolvedores

**Caio Vinicius Alves**\
**Victor Hugo Pereira da Silva**

Fatec Jahu - 2025
