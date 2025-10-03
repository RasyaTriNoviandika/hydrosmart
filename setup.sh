#!/bin/bash

# Hydro Smart - Quick Setup Script
# This script will help you setup the project quickly

echo "🚀 Starting Hydro Smart Setup..."
echo ""

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo -e "${RED}❌ Composer is not installed. Please install composer first.${NC}"
    exit 1
fi

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo -e "${RED}❌ PHP is not installed. Please install PHP first.${NC}"
    exit 1
fi

echo -e "${BLUE}📦 Installing Composer Dependencies...${NC}"
composer install

echo -e "${BLUE}🔑 Generating Application Key...${NC}"
php artisan key:generate

echo -e "${BLUE}📦 Installing QR Code Package...${NC}"
composer require simplesoftwareio/simple-qrcode

echo ""
echo -e "${GREEN}✅ Dependencies installed successfully!${NC}"
echo ""

# Ask for database configuration
echo -e "${BLUE}🗄️  Database Configuration${NC}"
read -p "Enter database name (default: hydro_smart): " db_name
db_name=${db_name:-hydro_smart}

read -p "Enter database username (default: root): " db_user
db_user=${db_user:-root}

read -sp "Enter database password (press enter if empty): " db_pass
echo ""

# Update .env file
if [ -f .env ]; then
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=$db_name/" .env
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=$db_user/" .env
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$db_pass/" .env
    echo -e "${GREEN}✅ .env file updated${NC}"
else
    cp .env.example .env
    php artisan key:generate
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=$db_name/" .env
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=$db_user/" .env
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$db_pass/" .env
    echo -e "${GREEN}✅ .env file created and configured${NC}"
fi

echo ""
echo -e "${BLUE}🗄️  Creating Database...${NC}"

# Try to create database
mysql -u"$db_user" -p"$db_pass" -e "CREATE DATABASE IF NOT EXISTS $db_name;" 2>/dev/null

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Database created successfully${NC}"
else
    echo -e "${RED}⚠️  Could not create database automatically. Please create it manually.${NC}"
fi

echo ""
echo -e "${BLUE}🔄 Running Migrations...${NC}"
php artisan migrate

if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Migration failed. Please check your database configuration.${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Migrations completed${NC}"

echo ""
echo -e "${BLUE}🌱 Seeding Database...${NC}"
php artisan db:seed --class=ProductSeeder

echo -e "${GREEN}✅ Database seeded with products${NC}"

echo ""
echo -e "${BLUE}🧹 Clearing Cache...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo -e "${GREEN}✅ Cache cleared${NC}"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo -e "${GREEN}🎉 Setup Completed Successfully!${NC}"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo -e "${BLUE}🚀 To start the server, run:${NC}"
echo -e "${GREEN}   php artisan serve${NC}"
echo ""
echo -e "${BLUE}🌐 Then open your browser at:${NC}"
echo -e "${GREEN}   http://localhost:8000${NC}"
echo ""
echo -e "${BLUE}📚 For more information, check README.md${NC}"
echo ""