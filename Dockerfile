FROM php:8.0.5-cli
FROM composer:2.0
COPY . /var/www/html
WORKDIR /var/www/html
CMD ["/bin/bash"]
