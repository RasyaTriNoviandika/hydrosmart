# Gunakan PHP 8.2 + Apache
FROM php:8.2-apache

# Install dependencies Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev zip curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project ke container
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel key
RUN php artisan key:generate

# Permission untuk Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port untuk Render
EXPOSE 80

# Jalankan Laravel di Apache
CMD ["apache2-foreground"]
