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
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql zip gd exif

# Install Redis extension
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader --verbose --ignore-platform-reqs \
    && rm -rf /root/.composer

# Copy the rest of the application code
COPY . .

# Install NPM dependencies and compile assets
COPY package.json package-lock.json ./
RUN npm install && npm run production

# Copy .env.production to .env
COPY .env.production .env

# Generate optimized autoload files
RUN composer dump-autoload --no-dev --optimize

# Set Laravel environment to production
ENV APP_ENV=production

# Run Laravel-specific commands
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Copy PHP configuration
COPY php.ini /usr/local/etc/php/conf.d/app.ini

# Copy Supervisor configuration
COPY supervisord.conf /etc/supervisord.conf

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Create necessary directories
RUN mkdir -p /var/log/supervisor /var/run

# Verify public directory contents
RUN ls -la /var/www/html/public

# Expose port 80
EXPOSE 80

# Start Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]