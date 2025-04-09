#!/bin/bash
composer install --no-dev --optimize-autoloader
npm install && npm run build
touch database/database.sqlite
chmod 775 database/database.sqlite  # Make writable
php artisan key:generate --force
php artisan migrate --force
php artisan optimize
