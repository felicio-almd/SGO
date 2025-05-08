# 🏗️ Sistema de Gerenciamento e Planejamento de Obras

Aplicação web php desenvolvida para facilitar o controle, planejamento e acompanhamento de obras. Permite o registro de projetos, fases da obra, equipe responsável, materiais e cronogramas.

## 🚀 Tecnologias Utilizadas

- **Laravel 11+** — Backend robusto em PHP
- **Docker** — Containerização da aplicação
- **TailwindCSS** — Estilização moderna e responsiva
- **MySQL** — Banco de dados relacional (desenvolvimento)
- **PostgreSQL** — Banco de dados usado em produção
- **Nginx + PHP-FPM** — Servidor web otimizado
- **Shell Script** — Automação do deploy

## 📦 Estrutura de Pastas Importantes

- `Dockerfile` — Define a imagem do Laravel para rodar o projeto
- `docker-compose.yml` — Orquestra os containers da aplicação (app + banco)
- `nginx-site.conf` — Configura o servidor Nginx
- `00-laravel-deploy.sh` — Script para build e inicialização no ambiente de produção

## ⚙️ Requisitos

- Docker + Docker Compose
- Git
- Make (opcional, para simplificar comandos)

## 🔧 Como rodar o projeto com Docker (desenvolvimento)

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/seu-usuario/sistema-obras.git
   cd sistema-obras
   ```

2. **Crie o `.env`**:
   ```bash
   cp .env.example .env
   ```

3. **Suba os containers**:
   ```bash
   docker-compose up -d --build
   ```

4. **Instale as dependências**:
   ```bash
   docker exec -it app composer install
   ```

5. **Gere a chave da aplicação**:
   ```bash
   docker exec -it app php artisan key:generate
   ```

6. **Execute as migrações e seeders**:
   ```bash
   docker exec -it app php artisan migrate --seed
   ```

7. Acesse via navegador:
   ```
   http://localhost
   ```

---

## 🐘 Produção com Render + PostgreSQL

- A aplicação está **implantada na Render**, utilizando o **PostgreSQL** como banco de dados.
- O build da aplicação usa `Dockerfile`.
- O script `00-laravel-deploy.sh` cuida da automação do deploy, incluindo:
  - Instalação de dependências
  - Migrações
  - Permissões de diretório
  - Otimização do cache

---

##  Funcionalidades

- Cadastro de obras
- Controle de materiais e recursos
- Cronograma e andamento de fases
- Relatórios por obra

---
