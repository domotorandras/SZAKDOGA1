# Stage 1: Build frontend assets
FROM node:18 AS frontend

WORKDIR /app

# Copy package files first for better caching
COPY package.json package-lock.json vite.config.js /app/
COPY resources /app/resources

# Install Node dependencies and build assets
RUN npm install && npm run build

# Stage 2: Build backend (Composer dependencies)
FROM composer:2 AS backend

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock /app/

# Install PHP dependencies (no dev dependencies for production)
RUN composer install --no-dev --no-scripts --no-autoloader --ignore-platform-reqs

# Copy all files and generate autoloader
COPY . /app
RUN composer dump-autoload --optimize

# Stage 3: Runtime
FROM php:8.2-apache

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy PHP dependencies from backend stage
COPY --from=backend /app/vendor /var/www/html/vendor

# Create public/build directory and copy assets if they exist
RUN mkdir -p /var/www/html/public/build
COPY --from=frontend /app/public/build/ /var/www/html/public/build/

# Copy manifest.json if it exists (suppress error if it doesn't)
RUN mkdir -p /var/www/html/public && \
    { [ -f /app/public/manifest.json ] && cp /app/public/manifest.json /var/www/html/public/ || true; }

# Copy application files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Environment variables (set these in docker-compose or at runtime)
ENV APP_ENV=production
ENV APP_DEBUG=false

# Expose port 80
EXPOSE 80

CMD ["./start.sh"]

# Health check
HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost/ || exit 1

