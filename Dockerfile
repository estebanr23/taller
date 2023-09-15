FROM php:8.2-fpm

# COPY . /var/www/html
COPY default.conf /etc/nginx/conf.d/default.conf

RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && \
     apt-get install -y \
         libzip-dev \
         && docker-php-ext-install zip

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG PUID=33
ARG PGID=33
# RUN groupmod -g $PGID www-data \
#     && usermod -u $PUID www-data

RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www

# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# CMD ["curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer"]
