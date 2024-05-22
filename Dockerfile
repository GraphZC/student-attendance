FROM php:8.3.4RC1-apache-bullseye
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite
RUN apt-get update && apt-get upgrade -y
