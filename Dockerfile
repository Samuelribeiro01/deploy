FROM php:8.3-cli

# Instalar extensões necessárias
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring xml bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copiar arquivos do projeto
COPY . .

# Instalar dependências PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Criar pastas necessárias para o Laravel
RUN mkdir -p storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    storage/logs \
    bootstrap/cache

# Permissões de storage
RUN chmod -R 775 storage bootstrap/cache

# Expor porta
EXPOSE 8000

# Script de inicialização
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan serve --host=0.0.0.0 --port=8000
