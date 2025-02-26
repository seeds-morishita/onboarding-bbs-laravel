#!/bin/sh

# composerをインストール
composer install --no-interaction

# アプリケーションキーを生成
php artisan key:generate

# マイグレーションを実行
php artisan migrate --force

# シーダーを実行
php artisan db:seed --force


apache2-foreground