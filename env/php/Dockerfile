FROM php:8.1-fpm

WORKDIR /app

RUN apt-get update && \
# создание пользователя
    useradd -s /bin/bash -d /home/worker/ -m -G sudo worker && \
# установка доп. пакетов через apt
    apt-get install zip unzip && \
# установка composer
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir="/usr/bin" --filename="composer" && \
    php -r "unlink('composer-setup.php');" && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
# установка symfony-cli
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash && \
    apt install -y symfony-cli && \
# подготовка к установке ext-redis
    mkdir -p /usr/src/php/ext/redis && \
    curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1 && \
# установка расширений php
    docker-php-ext-install redis

USER worker
