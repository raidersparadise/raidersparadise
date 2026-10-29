@echo off
REM Instalacion rapida de Raiders Paradise en Windows (requiere PHP 8.2+ y Composer)
cd /d %~dp0
echo == Raiders Paradise: instalacion ==
if not exist vendor\autoload.php ( call composer install ) else ( echo Dependencias PHP ya incluidas. )
if not exist .env copy .env.example .env
php artisan key:generate --ansi
if not exist database\database.sqlite type nul > database\database.sqlite
php artisan migrate:fresh --seed --force
echo.
echo Listo. Abre http://127.0.0.1:8000  (usuario admin@raidersparadise.co / Raiders2026*)
php artisan serve
