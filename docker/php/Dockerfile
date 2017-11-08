FROM php:7.0-apache

RUN apt-get update
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

COPY app.dev.conf /etc/apache2/sites-available/app.dev.conf

RUN a2ensite app.dev

RUN mkdir /codes; mkdir /codes/php-junior