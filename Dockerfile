# Use the official PHP 8.2 FPM image as the base
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    curl \
    zip unzip \
    git \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install Node.js and npm (for front-end dependencies)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

# Install front-end dependencies (npm)
RUN npm install && npm run build

# Install PHP dependencies (Composer)
RUN composer install --no-dev --optimize-autoloader

# Fix permissions (ensure proper access for Laravel's storage)
RUN chown -R www-data:www-data storage bootstrap/cache public/build
RUN chmod -R 775 storage bootstrap/cache public/build

RUN chmod -R 775 storage
RUN chown -R www-data:www-data storage


# Create a symbolic link for storage
RUN ln -s /var/www/html/storage/app/public /var/www/html/public/storage

# Expose the necessary port
EXPOSE 8000

# Clean up
RUN rm -rf /tmp/* /var/cache/apk/*

# Set the command to run the app
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
