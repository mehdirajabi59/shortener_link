FROM richarvey/nginx-php-fpm:latest
# Install composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

#Change nginx configuration
COPY ./nginx /etc/nginx
#Create directory for this product
RUN mkdir -p /var/www/html
WORKDIR /var/www/html

COPY . .
RUN composer install

