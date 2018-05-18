# Use Alpine Linux
FROM php:5.6-cli-alpine

# Maintainer
MAINTAINER Angel S. Moreno <angelxmoreno@gmail.com>

# Environments
ENV TIMEZONE            UTC
ENV PHP_MEMORY_LIMIT    512M

# Let's roll
RUN	apk update && \
	apk upgrade && \
	apk add --update \
		git \
    	openssh
#		php5-mcrypt \
#		php5-soap \
#		php5-openssl \
#		php5-gmp \
#		php5-pdo_odbc \
#		php5-json \
#		php5-dom \
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
#		php5-curl \
#		php5-ctype \
#		php5-phar \
#		php5-cli && \

# Set environments
#RUN	sed -i "s|;*date.timezone =.*|date.timezone = ${TIMEZONE}|i" /etc/php5/php.ini && \
#	sed -i "s|;*memory_limit =.*|memory_limit = ${PHP_MEMORY_LIMIT}|i" /etc/php5/php.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Cleaning up
RUN rm -rf /var/cache/apk/*

WORKDIR /usr/src/app

CMD tail -f /dev/null