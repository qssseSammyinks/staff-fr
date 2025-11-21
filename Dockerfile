# Usando PHP 8.3 Apache
FROM php:8.3-apache

# Ativa mod_rewrite do Apache
RUN a2enmod rewrite

# Instala dependências do sistema e PECL mongodb
RUN apt-get update && apt-get install -y \
    git unzip libssl-dev pkg-config && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia o código da aplicação
COPY . /var/www/html/

# Define diretório de trabalho
WORKDIR /var/www/html/

# Instala dependências PHP via Composer
RUN composer install --no-interaction --optimize-autoloader

# Permissões
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
