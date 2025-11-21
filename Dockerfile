# Stage 0: Base PHP + Apache
FROM php:8.3-apache

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-install zip

# Instalar MongoDB extension via PECL
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar código da aplicação
WORKDIR /var/www/html
COPY . /var/www/html

# Instalar dependências PHP do projeto
RUN composer install --no-interaction --optimize-autoloader

# Definir variáveis de ambiente
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Ajustar DocumentRoot do Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expor porta 80
EXPOSE 80

# Iniciar Apache em foreground
CMD ["apache2-foreground"]
