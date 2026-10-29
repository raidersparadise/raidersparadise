#!/usr/bin/env bash
# Instalación rápida de Raiders Paradise en macOS / Linux (requiere PHP 8.2+ y Composer)
set -e
cd "$(dirname "$0")"
echo "== Raiders Paradise: instalación =="
[ -f vendor/autoload.php ] || composer install
[ -f .env ] || cp .env.example .env
php artisan key:generate --ansi
[ -f database/database.sqlite ] || touch database/database.sqlite
php artisan migrate:fresh --seed --force
echo
echo "Listo. Abre http://127.0.0.1:8000  (usuario admin@raidersparadise.co / Raiders2026*)"
php artisan serve
