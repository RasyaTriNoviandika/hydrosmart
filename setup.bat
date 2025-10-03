@echo off
color 0A
title Hydro Smart - Quick Setup

echo ========================================
echo   Hydro Smart - Quick Setup Script
echo ========================================
echo.

REM Check if composer is installed
where composer >nul 2>nul
if %ERRORLEVEL% neq 0 (
    echo [ERROR] Composer is not installed!
    echo Please install composer first from https://getcomposer.org/
    pause
    exit /b 1
)

REM Check if PHP is installed
where php >nul 2>nul
if %ERRORLEVEL% neq 0 (
    echo [ERROR] PHP is not installed!
    echo Please install PHP first
    pause
    exit /b 1
)

echo [1/8] Installing Composer Dependencies...
call composer install
if %ERRORLEVEL% neq 0 (
    echo [ERROR] Failed to install composer dependencies
    pause
    exit /b 1
)
echo [OK] Dependencies installed
echo.

echo [2/8] Generating Application Key...
php artisan key:generate
echo [OK] Application key generated
echo.

echo [3/8] Installing QR Code Package...
call composer require simplesoftwareio/simple-qrcode
echo [OK] QR Code package installed
echo.

echo [4/8] Setting up Environment File...
if not exist .env (
    copy .env.example .env
    php artisan key:generate
)

REM Prompt for database configuration
set /p DB_NAME="Enter database name (default: hydro_smart): " || set DB_NAME=hydro_smart
set /p DB_USER="Enter database username (default: root): " || set DB_USER=root
set /p DB_PASS="Enter database password (press enter if empty): "

REM Update .env file using PowerShell
powershell -Command "(gc .env) -replace 'DB_DATABASE=.*', 'DB_DATABASE=%DB_NAME%' | Out-File -encoding ASCII .env"
powershell -Command "(gc .env) -replace 'DB_USERNAME=.*', 'DB_USERNAME=%DB_USER%' | Out-File -encoding ASCII .env"
powershell -Command "(gc .env) -replace 'DB_PASSWORD=.*', 'DB_PASSWORD=%DB_PASS%' | Out-File -encoding ASCII .env"

echo [OK] Environment configured
echo.

echo [5/8] Creating Database...
echo CREATE DATABASE IF NOT EXISTS %DB_NAME%; | mysql -u%DB_USER% -p%DB_PASS% 2>nul
if %ERRORLEVEL% equ 0 (
    echo [OK] Database created
) else (
    echo [WARNING] Could not create database automatically
    echo Please create database '%DB_NAME%' manually
)
echo.

echo [6/8] Running Migrations...
php artisan migrate
if %ERRORLEVEL% neq 0 (
    echo [ERROR] Migration failed
    echo Please check your database configuration
    pause
    exit /b 1
)
echo [OK] Migrations completed
echo.

echo [7/8] Seeding Database...
php artisan db:seed --class=ProductSeeder
echo [OK] Database seeded
echo.

echo [8/8] Clearing Cache...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo [OK] Cache cleared
echo.

echo ========================================
echo   Setup Completed Successfully!
echo ========================================
echo.
echo To start the server, run:
echo   php artisan serve
echo.
echo Then open your browser at:
echo   http://localhost:8000
echo.
echo For more information, check README.md
echo.
pause