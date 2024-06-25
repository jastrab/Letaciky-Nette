FROM php:8.3-fpm-alpine

RUN apk add --update --no-cache --virtual .ext-deps \
        autoconf \
        freetype-dev \
        g++ \
        icu-dev \
        linux-headers \
        libmcrypt-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev \
        make \
        pcre-dev

RUN \
    docker-php-ext-configure pdo_mysql && \
    docker-php-ext-configure zip && \
    docker-php-ext-configure opcache && \
    docker-php-ext-configure exif && \
    docker-php-ext-configure gd \
        --with-jpeg=/usr/include \
        --with-webp=/usr/include \
        --with-freetype=/usr/include && \
    docker-php-ext-configure intl && \
    docker-php-ext-configure sockets && \
    docker-php-ext-configure bcmath && \
    docker-php-ext-install pdo_mysql zip opcache exif gd intl sockets bcmath

ENV XDEBUG_VERSION=3.3.1
RUN \
    pecl install redis xdebug-${XDEBUG_VERSION} && \
    pecl clear-cache && \
    docker-php-ext-enable redis && \
    docker-php-ext-enable sodium && \
    docker-php-ext-enable xdebug && \
    docker-php-source delete \
    rm -r /tmp/pear/*

RUN apk add --update --no-cache \
        git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

