FROM serversideup/php:8.3-fpm-nginx

USER root
RUN install-php-extensions intl
RUN install-php-extensions gd
RUN install-php-extensions bcmath
RUN rm /usr/local/etc/php/conf.d/serversideup-docker-php.ini

COPY ./php/php.ini /usr/local/etc/php/conf.d/
ARG USER_ID
ARG GROUP_ID
RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID && \
    \
    # Update the file permissions for our NGINX service to match the new UID/GID
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx
USER www-data
COPY --chown=www-data:www-data ./src /var/www/html
RUN chgrp -R www-data storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chown -R www-data:www-data storage/app
RUN chown -R www-data:www-data storage/logs
# RUN composer install --no-interaction --optimize-autoloader --no-dev
# WORKDIR /var/www/html

# USER root
# CMD php artisan storage:link
# USER www-data