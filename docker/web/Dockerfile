# FROM seedsstd/seeds_apache_php:8.3-minimum

# # 必要な PHP 拡張をインストール
# RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql

# RUN echo "ServerName localhost" | tee /etc/apache2/conf-available/fqdn.conf
# RUN a2enconf fqdn

# # Apache の設定ファイルの修正（もしくは追加）
# RUN echo "<Directory /app>\n\
#     AllowOverride All\n\
#     Require all granted\n\
# </Directory>" >> /etc/apache2/apache2.conf


# # # タイムゾーンデータをインストール
# # RUN apt-get update && apt-get install -y tzdata

# # # Apache 設定の変更を反映
# # RUN a2ensite 000-default.conf
# # RUN a2enmod rewrite

# # # Apache を再起動する設定
# # RUN service apache2 restart


FROM seedsstd/seeds_apache_php:8.3-minimum
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql
RUN apt-get update && apt-get install -y vim