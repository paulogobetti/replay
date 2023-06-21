FROM php:7.2-apache

RUN apt-get update && apt-get install -y python3 && apt-get clean

COPY . /var/www/html

WORKDIR /var/www/html

VOLUME /home/$USER/.workspace/replay

#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
