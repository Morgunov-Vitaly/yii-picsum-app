FROM php:8.2-fpm

RUN apt-get update 
RUN apt-get install -y \
    curl \
    git \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libicu-dev \
    libpq-dev \
    libxpm-dev \
    libzip-dev

# sudo
RUN apt-get -y install sudo

# postgresql pdo
RUN docker-php-ext-install pdo_pgsql

# special configuration for gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd
RUN docker-php-ext-install -j$(nproc) gd

# composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#xDebug
RUN pecl install xdebug-3.2.2 \
    && docker-php-ext-enable xdebug

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

USER "1000:1000"

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /var/www

ENTRYPOINT ["php-fpm"]