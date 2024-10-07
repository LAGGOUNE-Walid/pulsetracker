FROM serversideup/php:8.3-fpm-nginx

USER root

RUN rm /usr/local/etc/php/conf.d/serversideup-docker-php.ini

COPY php.ini /usr/local/etc/php/conf.d/

USER www-data