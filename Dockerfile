FROM php:8.2-fpm

COPY composer.lock composer.json /var/www/

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libonig-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev

RUN apt-get update && apt-get install -y \
    software-properties-common \
    npm

RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest

# RUN pecl install redis-5.3.7 \
# 	&& pecl install xdebug-3.2.1 \
# 	&& docker-php-ext-enable redis xdebug

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# RUN apt-get update && apt-get install -y redis-tools
RUN apt-get update && apt-get install

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www

COPY --chown=www-data:www-data . /var/www

USER www

CMD ["php-fpm"]
