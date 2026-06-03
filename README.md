# ☕ Java Express — Cafeteria para Devs

Sistema completo de gerenciamento para a cafeteria Java Express, desenvolvido em Laravel 13.

## 🔐 Acesso Admin

| Campo | Valor |
|-------|-------|
| URL   | `/admin/login` |
| Email | `admin@javaexpress.com` |
| Senha | `admin123` |

## 📦 Funcionalidades

- **Tela inicial pública** com cardápio, hero e footer
- **Sistema de Login** com autenticação segura
- **Dashboard Admin** com estatísticas em tempo real
- **CRUD de Produtos** — criar, editar, listar e remover itens do cardápio
- **CRUD de Pedidos** — registrar pedidos com múltiplos produtos e cálculo automático de total
- **Filtros e busca** em produtos e pedidos
- **Paginação** nas listagens

## 🛠 Tecnologias

- Laravel 13 (PHP 8.3)
- Bootstrap 5.3
- PostgreSQL (produção) / SQLite (local)
- Font Awesome 6

---

## 🚀 Deploy no Render

### 1. Criar banco de dados PostgreSQL

1. Acesse [render.com](https://render.com) → **New → PostgreSQL**
2. Nome: `javaexpress-db`
3. Copie a **Internal Database URL** (formato: `postgres://user:pass@host/db`)

### 2. Criar o Web Service

1. **New → Web Service**
2. Conecte seu repositório GitHub
3. Configure:
   - **Runtime:** PHP
   - **Build Command:** `bash build.sh`
   - **Start Command:** `php artisan serve --host=0.0.0.0 --port=$PORT`

### 3. Variáveis de Ambiente

No Render, vá em **Environment** e adicione:

```
APP_NAME=Java Express
APP_ENV=production
APP_DEBUG=false
APP_URL=https://SEU-APP.onrender.com
APP_KEY=         ← gere com: php artisan key:generate --show

DB_CONNECTION=pgsql
DB_HOST=         ← Internal Host do seu PostgreSQL no Render
DB_PORT=5432
DB_DATABASE=     ← Nome do banco
DB_USERNAME=     ← Usuário
DB_PASSWORD=     ← Senha

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_LEVEL=error
```

### 4. Subir o projeto para o GitHub

```bash
git init
git add .
git commit -m "feat: Java Express completo com CRUD e autenticação"
git remote add origin https://github.com/SEU-USUARIO/ead1-deploy.git
git push -u origin main
```

### 5. Deploy automático

O Render detectará o push e rodará o `build.sh` automaticamente.
Após o deploy, acesse `/admin/login` com as credenciais acima.

---

## 💻 Rodar Localmente

```bash
# Instalar dependências
composer install
npm install

# Configurar ambiente
cp .env .env.local
# Edite .env.local: DB_CONNECTION=sqlite, DB_DATABASE=/caminho/database.sqlite

# Criar banco SQLite
touch database/database.sqlite

# Migrations + Seed
php artisan migrate --seed

# Iniciar servidor
php artisan serve
npm run dev
```
