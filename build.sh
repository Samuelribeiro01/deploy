#!/usr/bin/env bash
# build.sh — Script de deploy para Render.com
set -e

echo "=== Java Express — Build Script ==="

# Instalar dependências PHP
composer install --no-dev --optimize-autoloader --no-interaction

# Configurações Laravel para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Executar migrations
php artisan migrate --force

# Executar seeders
php artisan db:seed --force

echo "=== Build concluído com sucesso! ==="
