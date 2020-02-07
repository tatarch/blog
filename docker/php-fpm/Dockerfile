FROM php:7.2-fpm

RUN docker-php-ext-install mysqli pdo_mysql

RUN pecl install xdebug-2.7.0 \
    && docker-php-ext-enable xdebug

COPY php.ini $PHP_INI_DIR

CMD ["php-fpm"]

EXPOSE 9000

WORKDIR /var/www
