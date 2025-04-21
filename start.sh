#!/bin/bash

# NginxとPHP-FPMをフォアグラウンドで実行
service nginx start
php-fpm -F