FROM php:8.0-apache

RUN a2enmod rewrite

RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        zlib1g-dev 

RUN docker-php-ext-install gd

WORKDIR /var/www/html/
COPY . .

EXPOSE 80