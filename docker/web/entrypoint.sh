#!/bin/sh

# マイグレーションを実行
php artisan migrate --force

# シーダーを実行
php artisan db:seed --force

# アプリケーションキーを生成
php artisan key:generate

apache2-foreground