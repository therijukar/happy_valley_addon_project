FROM php:7.4-apache
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql intl zip gd && \
    a2enmod rewrite
WORKDIR /var/www/html
COPY . /var/www/html
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /var/www/html/runtime /var/www/html/web/assets || true
