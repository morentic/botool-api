FROM php:8.3-fpm-alpine

ADD php.ini "$PHP_INI_DIR/conf.d"

RUN apk update && apk upgrade

# install packages

RUN apk add bash curl git

# install symfony cli

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash \
  && apk add symfony-cli

# install php extensions

RUN apk add icu-dev && docker-php-ext-install intl

RUN docker-php-ext-install opcache

# install composer

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === trim(file_get_contents('https://composer.github.io/installer.sig'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# install mysql driver \

RUN docker-php-ext-install pdo pdo_mysql