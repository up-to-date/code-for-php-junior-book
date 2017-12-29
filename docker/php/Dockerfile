FROM php:7.0-apache

RUN apt-get update
RUN apt-get install wget git zip -y

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

RUN wget wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet

RUN mv composer.phar /usr/local/bin/composer

COPY dev.myapp.com.conf /etc/apache2/sites-available/dev.myapp.com.conf

RUN a2ensite dev.myapp.com
RUN a2enmod rewrite

RUN mkdir /codes; mkdir /codes/php-junior

WORKDIR /codes/php-junior