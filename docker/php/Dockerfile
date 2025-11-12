FROM php:8.4-fpm-alpine AS base

WORKDIR /var/www/html/backend

RUN apk add --no-cache \
        autoconf \
        automake \
        build-base \
        curl \
        gifsicle \
        jpegoptim \
        libavif \
        libavif-dev \
        libgcrypt-dev \
        libheif-dev \
        libmcrypt-dev \
        libtool \
        libuv-dev \
        libwebp-tools \
        libxml2-dev \
        libzip-dev \
        linux-headers \
        nasm \
        openssl \
        openssl-dev \
        optipng \
        pkgconf \
        pngquant \
        postgresql-client \
        postgresql-dev \
        procps \
        tzdata \
        ghostscript \
        ssmtp \
    && update-ca-certificates

# Install redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install ext
RUN docker-php-ext-configure zip && \
    docker-php-ext-install \
        bcmath \
        opcache \
        pcntl \
        pdo \
        pdo_pgsql \
        pgsql \
        zip

# Install Imagick extension from source (compatible with PHP 8.4)
RUN apk add --update --no-cache --virtual .imagick-runtime-deps \
        imagemagick \
        imagemagick-dev \
        git \
        $PHPIZE_DEPS \
    && git clone --depth 1 https://github.com/Imagick/imagick.git /tmp/imagick \
    && cd /tmp/imagick \
    && phpize \
    && ./configure \
    && make -j$(nproc) \
    && make install \
    && docker-php-ext-enable imagick \
    && rm -rf /tmp/imagick

# Install gd extension
RUN apk add --no-cache \
        libjpeg-turbo-dev \
        libpng-dev \
        freetype-dev
RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd

# Install intl extension
RUN apk add --no-cache icu-libs \
  && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev \
  && docker-php-ext-install intl

# Install exif extension
RUN docker-php-ext-install exif \
  && docker-php-ext-enable exif

# PHP - config folder
ENV PHP_INI_CONF_DIR="$PHP_INI_DIR/conf.d"
ENV PHP_FPM_INI_CONF_DIR="$PHP_INI_DIR/../php-fpm.d"

# PHP CLI - config
COPY ./config/php.ini $PHP_INI_CONF_DIR/php_custom.ini

# PHP FPM - config
COPY ./config/www.conf $PHP_FPM_INI_CONF_DIR/www_custom.conf

# Set time zone
ARG TZ="Europe/Moscow"

# Set time zone System
RUN cp /usr/share/zoneinfo/Europe/Moscow /etc/localtime
RUN echo "$TZ" >  /etc/timezone

# Time Zone PHP
RUN echo "$TZ" > $PHP_INI_DIR/conf.d/timezone.ini

# Config Sendmail
COPY ./ssmtp.conf /etc/ssmtp/ssmtp.conf

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install nodejs
RUN apk add --no-cache \
    nodejs \
    npm

# Install svgo
RUN npm install --global svgo

# Install mozjpeg
RUN npm install --global mozjpeg

# Clear
RUN docker-php-source delete \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

# Set user
ARG DOCKER_USER
ARG DOCKER_UID
ARG DOCKER_GROUP
ARG DOCKER_GID

# Set user
ENV DOCKER_USER=$DOCKER_USER
ENV DOCKER_UID=$DOCKER_UID
ENV DOCKER_GROUP=$DOCKER_GROUP
ENV DOCKER_GID=$DOCKER_GID

# Create system user
RUN addgroup -g $DOCKER_GID $DOCKER_GROUP
RUN adduser -G $DOCKER_GROUP -u $DOCKER_UID -D -h /home/$DOCKER_USER $DOCKER_USER

# Set PHP user
RUN echo "user=$DOCKER_USER" >> $PHP_FPM_INI_CONF_DIR/www_custom.conf
RUN echo "group=$DOCKER_GROUP" >> $PHP_FPM_INI_CONF_DIR/www_custom.conf

# DEVELOPMENT
FROM base AS development

# Install Pecl extension
RUN pecl install xdebug-3.4.5 && \
  docker-php-ext-enable xdebug

# Config Xdebug extension
COPY ./config/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

# Config Error
RUN echo "php_admin_value[error_reporting] = E_ALL" >> $PHP_FPM_INI_CONF_DIR/www_custom.conf

USER $DOCKER_USER:$DOCKER_GROUP

CMD ["php-fpm"]


# PRODUCTION
FROM base AS production

USER $DOCKER_USER:$DOCKER_GROUP

CMD ["php-fpm"]

# CRON
FROM production AS cron

USER root

# Set crontab
COPY ./crontab /etc/crontab
RUN crontab -u $DOCKER_USER /etc/crontab


CMD ["crond", "-f"]
