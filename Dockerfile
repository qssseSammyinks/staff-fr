FROM php:8.3-apache

RUN aZenmod rewrite

RUN apt-get update && apt-get install -y \
    git unzip libssl-dev pkg-config && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html/

WORKDIR /var/www/html/

RUN composer install -no-interaction -optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80