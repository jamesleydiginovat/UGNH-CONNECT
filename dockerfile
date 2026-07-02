# Base PHP
FROM php:8.3-cli

# Dossier de travail
WORKDIR /var/www

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev

# Extensions PHP nécessaires pour Laravel + PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql zip

# Installer Node.js LTS (important pour Vite/Tailwind)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Copier le projet
COPY . .

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Installer dépendances PHP (Laravel)
RUN composer install --no-dev --optimize-autoloader

# Installer dépendances frontend + build Tailwind/Vite
RUN npm install
RUN npm run build

# Permissions Laravel
RUN chmod -R 775 storage bootstrap/cache

# Port Render
EXPOSE 10000

# Démarrage du serveur Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000