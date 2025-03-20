# Use an official PHP runtime as the base image
FROM php:8.2-fpm

# Set the working directory
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    curl \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Copy the composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy Nginx configuration
COPY ./nginx.conf /etc/nginx/sites-available/default

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm