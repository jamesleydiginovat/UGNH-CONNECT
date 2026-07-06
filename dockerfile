
FROM php:8.4-cli
# =========================
# SYSTEM DEPENDENCIES
# =========================
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        mbstring \
        zip \
        exif \
        pcntl \
        bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
# =========================
# COMPOSER
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# =========================
# COPY PROJECT FILES
# =========================
COPY . .

# =========================
# INSTALL PHP DEPENDENCIES
# =========================

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts
# =========================
# INSTALL NODE DEPENDENCIES
# =========================
RUN npm install

# =========================
# BUILD FRONTEND ASSETS
# =========================
RUN npm run build



# =========================
# PERMISSIONS
# =========================
RUN chmod -R 775 storage bootstrap/cache

# =========================
# EXPOSE PORT
# =========================
EXPOSE 8080

# =========================
# START APPLICATION james
# =========================
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}