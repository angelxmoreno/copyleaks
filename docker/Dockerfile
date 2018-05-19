# Use Alpine Linux
FROM alpine:3.5

# Maintainer
MAINTAINER Angel S. Moreno <angelxmoreno@gmail.com>

# Environments
ENV TIMEZONE            UTC
ENV PHP_MEMORY_LIMIT    512M
ENV XDEBUG_VERSION      2.5.5
ENV XDEBUG_PORT         9000

# Let's roll
# Pre run
RUN set -ex \
    && apk update \
    && apk upgrade \

    && apk add --update --virtual .build-deps autoconf g++ make pcre-dev icu-dev openssl-dev


RUN set -ex \
	&& apk add --update \
	    curl \
		git \
    	openssh \
    	php5-xdebug \
#		php5-mcrypt \
#		php5-soap \
		php5-openssl \
#		php5-gmp \
#		php5-pdo_odbc \
		php5-json \
		php5-dom \
#		php5-pdo \
#		php5-zip \
#		php5-mysql \
#		php5-sqlite3 \
#		php5-apcu \
#		php5-pdo_pgsql \
#		php5-bcmath \
#		php5-gd \
#		php5-xcache \
#		php5-odbc \
#		php5-pdo_mysql \
#		php5-pdo_sqlite \
#		php5-gettext \
#		php5-xmlreader \
#		php5-xmlrpc \
#		php5-bz2 \
#		php5-memcache \
#		php5-mssql \
#		php5-iconv \
#		php5-pdo_dblib \
		php5-curl \
#		php5-ctype \
		php5-phar \
		php5-cli

# Set environments
#RUN	sed -i "s|;*date.timezone =.*|date.timezone = ${TIMEZONE}|i" /etc/php5/php.ini && \
#	sed -i "s|;*memory_limit =.*|memory_limit = ${PHP_MEMORY_LIMIT}|i" /etc/php5/php.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer


# setup XDebug
RUN set -ex \
    && echo "zend_extension=xdebug.so" > /etc/php5/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /etc/php5/conf.d/xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /etc/php5/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /etc/php5/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /etc/php5/conf.d/xdebug.ini \
    && echo "xdebug.remote_port=${XDEBUG_PORT}" >> /etc/php5/conf.d/xdebug.ini

# Cleaning up
RUN apk del --purge .build-deps \
    && rm -rf /tmp/pear \
    && rm -rf /var/cache/apk/*

WORKDIR /usr/src/app
EXPOSE ${XDEBUG_PORT}

CMD tail -f /dev/null