# Imagen base con PHP 8.2 + Apache
FROM php:8.2-apache

# Instalar extensiones y dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip mbstring exif pcntl bcmath opcache intl \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto (usa .dockerignore para evitar vendor y node_modules)
COPY . .

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configurar permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configurar Apache para servir Laravel desde /public
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Exponer el puerto HTTP
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
