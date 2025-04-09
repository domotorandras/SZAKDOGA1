#!/bin/bash
# Install dependencies
composer install --no-dev --optimize-autoloader
npm install && npm run build

# Create SQLite database if missing
if [ ! -f database/database.sqlite ]; then
  touch database/database.sqlite
fi

# Set permissions
chmod 775 database/database.sqlite

# Generate keys and optimize
php artisan key:generate --force
php artisan optimize:clear
php artisan optimize
