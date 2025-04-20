# Gunakan PHP versi 8.1 dengan Apache
FROM php:8.2.12-apache

# Copy semua file ke direktori web server
COPY . /var/www/html/

# Expose port yang digunakan web server
EXPOSE 80
