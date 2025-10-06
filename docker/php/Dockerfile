FROM php:8.3-apache

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Apache config & init scripts
COPY docker/php/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/init.dev.sh /usr/local/bin/init.dev.sh
COPY docker/php/init.prod.sh /usr/local/bin/init.prod.sh

RUN chmod +x /usr/local/bin/init.dev.sh /usr/local/bin/init.prod.sh

WORKDIR /var/www/html

# Default jalankan init.dev.sh (biar enak untuk local dev)
CMD ["bash", "/usr/local/bin/init.dev.sh"]

# Jika Prod jalankan init.prod.sh (Untuk Prod)
# CMD ["bash", "/usr/local/bin/init.prod.sh"]
