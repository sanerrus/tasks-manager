FROM php:7.4.0-fpm-alpine3.10

ENV TZ=Europe/Moscow

RUN docker-php-ext-install sockets && set -x && addgroup -g 101 -S nginx \
&& adduser -u 101 -D -S -G nginx nginx \
&& mkdir -p /var/www/tasks-manager \
&& apk update \
&& apk add bash tzdata git autoconf gcc g++ make pkgconfig zlib-dev libmemcached-dev curl-dev libpq unixodbc-dev mariadb-dev mysql-dev yaml-dev \
libevent-dev icu-dev libidn-dev spl \
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php -r "if (hash_file('sha384', 'composer-setup.php') === 'c5b9b6d368201a9db6f74e2611495f369991b72d9c8cbd3ffbc63edff210eb73d46ffbfce88669ad33695ef77dc76976') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
&& php composer-setup.php --install-dir=/usr/bin/ --filename=composer \
&& '' | pecl install -o redis && docker-php-ext-enable --ini-name 00-redis.ini redis \
&& '' | pecl install -o memcached && docker-php-ext-enable --ini-name 01-memcached.ini memcached \
&& '' | pecl install -o raphf && docker-php-ext-enable --ini-name 02-raphf.ini raphf \
&& '' | pecl install -o propro && docker-php-ext-enable --ini-name 03-propro.ini propro \
&& '' | pecl install -o pecl_http && docker-php-ext-enable --ini-name 04-http.ini http \
&& '' | pecl install -o yaml && docker-php-ext-enable --ini-name 05-yaml.ini yaml \
&& docker-php-ext-install pdo_mysql \
&& ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN mkdir /run/mysqld

WORKDIR /var/www/tasks-manager
CMD composer install; echo -e "extension=pdo_mysql.so\npdo_mysql.default_socket=/run/mysqld/mysqld.sock" > /usr/local/etc/php/conf.d/docker-php-ext-pdo_mysql.ini; /usr/local/sbin/php-fpm -F -R