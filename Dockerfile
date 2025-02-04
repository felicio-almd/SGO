# Use uma imagem PHP oficial com Apache
FROM php:8.2-apache

# Instale dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Limpe o cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instale extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Configure o diretório de trabalho
WORKDIR /var/www/html


# Copie os arquivos do projeto
COPY . /var/www/html

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instale as dependências do Composer
RUN composer install --no-interaction --no-scripts --no-progress --prefer-dist

# Configure permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copie a configuração do Apache
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Habilite mod_rewrite
RUN a2enmod rewrite

RUN a2ensite 000-default

# Exponha a porta 80
EXPOSE 8080

# Comando para iniciar o Apache
CMD ["apache2-foreground"]