FROM php:8.1.16-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install npm git unzip libzip-dev libicu-dev libonig-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

#最新のnodeを使う
RUN curl -sL https://deb.nodesource.com/setup_current.x | bash -
RUN apt install -y nodejs

RUN docker-php-ext-install opcache
RUN docker-php-ext-install pdo_mysql
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /framework
