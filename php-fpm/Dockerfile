FROM php:7.2-fpm

# Set working directory
WORKDIR /usr/share/nginx/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \    
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN chown -R www-data:www-data /usr/share/nginx/html
RUN chmod -R 755 /usr/share/nginx/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
