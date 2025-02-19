FROM seedsstd/seeds_apache_php:8.3-minimum
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql
RUN apt-get update && apt-get install -y vim