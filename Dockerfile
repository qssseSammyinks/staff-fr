FROM php:8.3-apache

# Instala dependências do PHP
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev libssl-dev libcurl4-openssl-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Copia todos os arquivos do projeto para dentro do container
COPY . /var/www/html/
WORKDIR /var/www/html/

# Dá permissão para pasta de uploads
RUN chown -R www-data:www-data /var/www/html/uploads

# Expondo porta padrão HTTP
EXPOSE 80
