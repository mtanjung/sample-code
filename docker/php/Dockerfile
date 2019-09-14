#FROM php:7.2.7-fpm-alpine3.7
FROM php:7.0-fpm-alpine3.7

COPY www.conf /usr/local/etc/php-fpm.d/www.conf

RUN apk update; \
    apk upgrade;

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Run KO bootstrap

#CMD ["php", "/var/www/proto/portal/symfony", "keywordobjects:bootstrap-config"]

#CMD php /var/www/proto/portal/symfony keywordobjects:bootstrap-config
#CMD php /var/www/proto/ppc/symfony keywordobjects:bootstrap-config
#CMD php /var/www/proto/seo/symfony keywordobjects:bootstrap-config
#CMD php /var/www/proto/admin/symfony keywordobjects:bootstrap-config
#CMD php /var/www/proto/aud/bootstrap.php
#CMD php /var/www/proto/da/bootstrap.php
#CMD php /var/www/proto/dash/bootstrap.php

# Run KO Stuff! need to be at the app directory! at least for DA
#RUN php /var/www/proto/aud/app/console assets:install --symlink --relative
#RUN php /var/www/proto/da/app/console assets:install --symlink --relative
#RUN php /var/www/proto/dash/app/console assets:install --symlink --relative

#CMD ["php", "/var/www/proto/da/app/console assets:install --symlink --relative"]
#CMD ["php", "/var/www/proto/aud/app/console assets:install --symlink --relative"]
#CMD ["php", "/var/www/proto/dash/app/console assets:install --symlink --relative"]