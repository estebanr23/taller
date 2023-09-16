# Utiliza la imagen oficial de PHP con Apache
FROM php:8.2.10-apache

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de tu proyecto a la imagen
COPY . .

# Instala las dependencias de PHP
RUN apt-get update && \
    apt-get install -y \
    git \
    zip \
    unzip && \
    docker-php-ext-install pdo_mysql && \
    a2enmod rewrite

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala las dependencias de tu proyecto
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Verifica permisos y habilita mod_rewrite
RUN chmod -R 755 /var/www/html && \
    chown -R www-data:www-data /var/www/html
    
# Copia el archivo de configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilita el sitio de Apache
RUN a2ensite 000-default.conf


# Define el puerto que usará la aplicación
EXPOSE 80

# Comando para iniciar el servidor Apache
CMD ["apache2-foreground"]
