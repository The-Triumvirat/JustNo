FROM node:22-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY public ./public
COPY postcss.config.js tailwind.config.js vite.config.js ./
RUN npm run build

FROM php:8.4-fpm-alpine AS app
ENV APP_ENV=production COMPOSER_ALLOW_SUPERUSER=1
RUN apk add --no-cache icu-libs libzip oniguruma \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev libzip-dev oniguruma-dev \
    && docker-php-ext-install -j"$(nproc)" intl mbstring pdo_mysql zip opcache \
    && apk del .build-deps
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY --chown=www-data:www-data . .
COPY --from=frontend --chown=www-data:www-data /app/public/build ./public/build
COPY docker/php.ini /usr/local/etc/php/conf.d/justno.ini
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --classmap-authoritative \
    && composer clear-cache \
    && mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs public/upload/profile_images \
    && chown -R www-data:www-data storage bootstrap/cache public/upload/profile_images
USER www-data
EXPOSE 9000
CMD ["php-fpm"]

FROM nginx:1.28-alpine AS web
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=app /var/www/html/public /var/www/html/public
EXPOSE 80
