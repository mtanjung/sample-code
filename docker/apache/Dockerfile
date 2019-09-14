FROM httpd:2.4.33-alpine

RUN apk update; \
    apk upgrade;

# Copy apache vhost file to proxy php requests to php-fpm container
COPY proto.apache.conf /usr/local/apache2/conf/proto.apache.conf



RUN echo "Include /usr/local/apache2/conf/proto.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf

COPY server.crt /usr/local/apache2/conf/server.crt
COPY server.key /usr/local/apache2/conf/server.key


#RUN sed -i \
#        -e 's/^#\(Include .*httpd-ssl.conf\)/\1/' \
#        -e 's/^#\(LoadModule .*mod_ssl.so\)/\1/' \
#        -e 's/^#\(LoadModule .*mod_socache_shmcb.so\)/\1/' \
#        /usr/local/apache2/conf/httpd.conf
#        #conf/httpd.conf

# Run
#RUN chmod 777 /var/www/proto/portal/cache/ /var/www/proto/portal/log/