#!/bin/sh

# マイグレーションを実行
php artisan migrate --force

# シーダーを実行
php artisan db:seed --force

apache2-foreground