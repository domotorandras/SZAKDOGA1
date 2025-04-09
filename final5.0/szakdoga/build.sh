#!/bin/bash
# Install PHP and required extensions (for Ubuntu-based Render environment)
sudo apt-get update && sudo apt-get install -y php php-cli php-mbstring php-xml php-sqlite3

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install && npm run build

# Set up SQLite database
touch database/database.sqlite
chmod 775 database/database.sqlite

# Laravel setup
php artisan key:generate --force
php artisan migrate --force
php artisan optimize
