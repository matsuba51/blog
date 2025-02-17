# ベースイメージとして Ubuntu 24.04 を使用
FROM ubuntu:24.04

# 作業ディレクトリを設定
WORKDIR /var/www/html

# タイムゾーンを設定
RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo "UTC" > /etc/timezone

# 必要なパッケージをインストール
RUN apt-get update && apt-get upgrade -y

# PHP をインストールするための準備
RUN apt-get install -y software-properties-common curl && \
    add-apt-repository -y ppa:ondrej/php && \
    apt-get update

# PHP 8.3 と必要な拡張をインストール
RUN apt-get install -y php8.3-cli php8.3-fpm php8.3-mysql php8.3-mbstring php8.3-xml php8.3-curl php8.3-bcmath

# Composer をインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Composer が正しくインストールされたかを確認
RUN composer --version

# UID 1000 のユーザーがすでに存在する場合は作成しない
RUN getent passwd 1000 || (groupadd --force -g 1000 sail && useradd -m -u 1000 -g sail sail)

# PHP の設定ファイルをコピー
COPY . /var/www/html

# コンテナ起動時のコマンド
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]

# Opcache 有効化
RUN echo "opcache.enable=1" >> /etc/php/8.3/fpm/conf.d/10-opcache.ini
RUN echo "opcache.memory_consumption=128" >> /etc/php/8.3/fpm/conf.d/10-opcache.ini
