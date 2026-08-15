FROM php:8.2-fpm
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    && docker-php-ext-install pdo pdo_mysql

RUN git clone --depth 1 https://github.com/smarty-php/smarty.git /usr/local/lib/php/Smarty \
    && rm -rf /usr/local/lib/php/Smarty/.git


COPY . /var/www/html

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]