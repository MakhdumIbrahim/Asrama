FROM php:8.2-apache

# Install ekstensi PHP & dependensi sistem
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Buat folder storage & beri izin akses penuh ke Apache (www-data)
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Konfigurasi Apache Document Root ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# AGAR RENDER MENDETEKSI PORT DENGAN BENAR:
# Mengubah port default Apache ke port 80 secara global dan mengizinkan binding ke 0.0.0.0
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN sed -i 's/Listen 80/Listen 0.0.0.0:80/g' /etc/apache2/ports.conf
RUN sed -i 's/:80/:80/g' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

# Menghapus file cache bawaan dari lokal agar Laravel menggunakan Environment Render
RUN rm -f bootstrap/cache/*.php

# Meneruskan log Laravel ke terminal Render agar pesan error terlihat
RUN ln -sf /dev/stdout /var/www/html/storage/logs/laravel.log

EXPOSE 80

# Perintah otomatis agar Apache berjalan di foreground dengan port yang benar
CMD /bin/bash -c "sed -i \"s/Listen .*/Listen 0.0.0.0:\${PORT:-80}/g\" /etc/apache2/ports.conf && sed -i \"s/\*:[0-9]*/\*:\${PORT:-80}/g\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"