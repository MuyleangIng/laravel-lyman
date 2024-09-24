# Use PHP FPM Alpine as base image
FROM php:8.1-fpm-alpine

# Install dependencies and PHP extensions
RUN apk add --no-cache \
    nginx \
    supervisor \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    autoconf \
    g++ \
    make \
    && docker-php-ext-install pdo pdo_mysql zip gd exif

# Install Redis extension
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first to leverage Docker cache
COPY composer.json composer.lock ./

# Install Laravel dependencies with verbose output and ignoring platform reqs
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader --verbose --ignore-platform-reqs \
    && rm -rf /root/.composer

# Copy the rest of the application code
COPY . .

# Copy .env.production to .env
COPY .env.production .env

# Generate optimized autoload files
RUN composer dump-autoload --no-dev --optimize

# Set Laravel environment to production
ENV APP_ENV=production

# Run Laravel-specific commands
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Copy PHP configuration
COPY php.ini /usr/local/etc/php/conf.d/app.ini

# Copy Supervisor configuration
COPY supervisord.conf /etc/supervisord.conf

# Create necessary directories and set permissions
RUN mkdir -p /var/log/supervisor /var/run \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expose port 80
EXPOSE 80

# Start Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]