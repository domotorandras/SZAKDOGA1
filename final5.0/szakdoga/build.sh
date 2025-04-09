#!/bin/bash
npm install
npm run build
composer install --no-dev --no-interaction --optimize-autoloader
php artisan optimize:clear
php artisan optimize