FROM php:7.3.4

LABEL maintainer="adrian.borkiet@gmail.com"

RUN apt-get update && apt-get install -y \
        libxml2-dev \
    && docker-php-ext-install simplexml

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

COPY . /usr/src/sample

WORKDIR /usr/src/sample

RUN composer install --prefer-source --no-interaction

ENTRYPOINT php -S 0.0.0.0:8080 index.php