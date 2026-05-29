# Laravel + PHP + Composer
FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        libpq-dev \
        libzip-dev \
        unzip \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        npm \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application code
COPY . /var/www

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
