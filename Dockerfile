FROM php:8.3-fpm

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    nginx \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Composerインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ作成
WORKDIR /var/www

# Laravelコードをコピー
COPY . .

# vendor ディレクトリ作成（composer install）
RUN composer install --no-dev --optimize-autoloader

# Laravel設定
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# パーミッション
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

# Nginx の設定ファイルをコピー
COPY nginx/default.conf /etc/nginx/sites-available/default

# Nginx と PHP-FPM を同時に起動するためのスクリプトを実行
CMD ["/start.sh"]

EXPOSE 80
