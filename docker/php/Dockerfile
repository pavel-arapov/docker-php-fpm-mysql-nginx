FROM php:7-fpm

RUN apt-get update \
	&& apt-get install -y --no-install-recommends \
		libfontconfig1 \
		libfreetype6 \
		libfreetype6-dev \
		libjpeg62-turbo \
		libjpeg62-turbo-dev \
		libmcrypt-dev \
		libmcrypt4 \
		libpng12-0 \
		libpng12-dev \
		libxml2-dev \
		libxrender1 \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install \
		gd \
		mbstring \
		mcrypt \
		mysqli \
		pdo_mysql \
		soap \
	&& rm /usr/local/etc/php/conf.d/docker-php-ext-mcrypt.ini \
	&& apt-get remove -y --purge --auto-remove \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libmcrypt-dev \
		libpng12-dev \
		libxml2-dev \
	&& rm -r /var/lib/apt/lists/*

RUN apt-get update \
	&& apt-get install -y --no-install-recommends \
		git \
	&& rm -r /var/lib/apt/lists/*

RUN yes | pecl install xdebug \
	&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
	&& echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
	&& echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN sed -i \
		-e 's/user = www-data/user = root/' \
		-e 's/group = www-data/group = root/' \
		/usr/local/etc/php-fpm.d/www.conf

#COPY docker-entrypoint.sh /docker-entrypoint.sh
#ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["php-fpm", "-R"]