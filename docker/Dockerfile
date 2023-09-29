# Imagem baseada no PHP e Servidor Apache
FROM php:8.1-apache
#FROM php:8.1.0-apache

# Cria o Virtual Host no Servidor Apache
COPY apache/site.conf /etc/apache2/sites-available/000-default.conf

# Mod Rewrite
RUN a2enmod rewrite

# Bibliotecas necessárias no Linux para rodarmos algumas funcionalidades
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    wget \
    git \
    unzip

# Adiciona o CRON do Laravel
RUN echo "* * * * * cd /var/www/html && /usr/local/bin/php artisan schedule:run >> /dev/null 2>&1" > /var/log/laravel-schedule.log

# Instala o Composer no Container
COPY --from=composer:2.5.1 /usr/bin/composer /usr/bin/composer

# Instalação de extensões do PHP
RUN docker-php-ext-install gettext intl pdo_mysql gd

# Configura a biblioteca gráfica GD no Linux
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) gd

# Instala o XDebug
RUN pecl install -o -f xdebug \
    && docker-php-ext-enable xdebug

# Configura o PHP
COPY ./php/php.ini /usr/local/etc/php/

# Diretório raiz da aplicação, dentro do Container
WORKDIR /var/www/html

# Start Apache in foreground
CMD ["apache2-foreground"]