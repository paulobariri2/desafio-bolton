ARG APACHE_VERSION=""
FROM httpd:${APACHE_VERSION:+${APACHE_VERSION}-}alpine

RUN apk update; \
    apk upgrade;

# Copy apache vhost file to proxy php requests to php-fpm container
COPY bolton.apache.conf /usr/local/apache2/conf/bolton.apache.conf
RUN echo "Include /usr/local/apache2/conf/bolton.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf
