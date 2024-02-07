# Use the official PHP image from Docker Hub
FROM php:8.2-apache

# Enable the Apache module called rewrite
RUN a2enmod rewrite

# Copy all files from src folder into the container's /var/www/html directory
COPY src/* /var/www/html/

# Expose port 80 to access the Apache web server
EXPOSE 80