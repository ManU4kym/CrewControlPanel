# Use the official PHP image as the base image
FROM php:8.2-fpm

# Install system dependencies and extensions
RUN apt-get update && apt-get install -y 
 #   libpng-dev \
  #  libjpeg-dev \
   # libfreetype6-dev \
    #zip \
    #unzip \
    #git

#RUN docker-php-ext-install pdo pdo_mysql zip intl

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy the Laravel application files to the container
COPY . .

# Copy the composer.json file from your project root into the container
COPY composer.json .

# Install Laravel dependencies
RUN composer install

# Generate Laravel application key
RUN php artisan key:generate

# Expose port 9000 to communicate with a web server (e.g., Nginx)
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php-fpm"]
